<?php
/*
* $ID PROJECT: Paste - mysql.php, v2 J.Samuel - 10/03/2013 GMT+1 (dd/mm/yy/)
* 
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 3
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*/
 
// Database handler
class DB extends PDO
{
	public $dblink;
	var $dbresult;
	// Constructor - establishes DB connection
	public function __construct()
	{
		global $CONF;
		try {
			parent::__construct('mysql:host=' . $CONF["dbhost"] . ';dbname=' . $CONF["dbname"], $CONF["dbuser"], $CONF["dbpass"]);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
	
    // How many pastes are in the database?
    public function getPasteCount()
    {
    	return $this->query('select count(*) as cnt from paste')->fetchColumn(); 
    }
    
    // Delete oldest $deletecount pastes from the database.
    public function trimPastes($deletecount)
    {
    	// Build a one-shot statement to delete old pastes
		$sql='delete from paste where pid in (';
		$sep='';
		$this->query("select * from paste order by posted asc limit $deletecount");
		while ($this->_next_record())
		{
			$sql.=$sep.$this->_f('pid');
			$sep=',';
		}
		$sql.=')';
		// Delete extra pastes.
		$this->exec($sql);	
    }
    
    // Delete all expired pastes.
    public function deleteExpiredPastes()
    {
    	$this->exec("DELETE FROM paste WHERE expires is not null and now() > expires");	
    }
	
    // Add 1 hit
    public function addHit($pid)
    {
    	$core = $this->prepare("UPDATE paste SET hits=hits+1 WHERE pid=:pid");	
		$core->execute(array(
			':pid' => $pid,
		));
    }
    
    // Add paste and return ID.
    public function addPost($title,$format,$code,$parent_pid,$expiry_flag,$password)
    {
    	//figure out expiry time
    	switch ($expiry_flag)
    	{
    		case 'd':
    			$expires="DATE_ADD(NOW(), INTERVAL 1 DAY)";
    			break;
			case 'f':
				$expires="NULL";
				break;
			default:
    			$expires="DATE_ADD(NOW(), INTERVAL 1 MONTH)";
    			break;	
    	}
		$insert = $this->prepare(
			'INSERT INTO paste (title, posted, format, code, parent_pid, expires, expiry_flag, password)
			 VALUES (:title, NOW(), :format, :code, :parent_pid, '.$expires.', :expiry_flag, :password)'
		);
		$insert->execute(array(
			':title' => $title,
			':format' => $format,
			':code' => $code,
			':parent_pid' => $parent_pid,
			':expiry_flag' => $expiry_flag,
			':password' => $password
		));
		return $this->lastInsertId();
    }
    
    // Return entire paste row for given ID.
	public function getPaste($id)
    {
		$qid = $this->prepare('SELECT *, DATE_FORMAT(posted, \'%M %a %D %l:%i %p\') AS postdate FROM paste WHERE pid= :pid');
		$qid->execute(array(
			':pid' => $id
		));
		while( $row=$qid->fetch(PDO::FETCH_ASSOC) )
    	if ($row)
			return $row;
		else
			return false;
		
    }
	
    // Return search results - very basic search engine to be improved!
    public function getSearch($keywords)
    {
    	$posts=array();
		$qid = $this->prepare("SELECT pid,title,code,unix_timestamp()-unix_timestamp(posted) AS age, date_format(posted, '%a %D %b %H:%i') AS postdate FROM paste WHERE title LIKE :keywords OR code LIKE :keywords ORDER BY posted DESC, pid DESC");
		$qid->execute(array(
			':keywords' => '%' . $keywords . '%'
		));
		while( $row=$qid->fetch(PDO::FETCH_ASSOC) )
			$posts[]=$row;
    	if ($posts)
			return $posts;
		else
			return false;
    }
	
    // Return trending pastes
    public function getTrends()
    {
    	$posts=array();
		$qid = $this->prepare("SELECT pid,hits,format,expires,title,code,unix_timestamp()-unix_timestamp(posted) AS age, date_format(posted, '%a %D %b %H:%i') AS postdate FROM paste ORDER BY hits DESC LIMIT 10");
		$qid->execute(array());
		while( $row=$qid->fetch(PDO::FETCH_ASSOC) )
			$posts[]=$row;
    	if ($posts)
			return $posts;
		else
			return false;
    }
    
    // Return summaries for $count posts ($count=0 means all)
    public function getRecentPostSummary($count)
    {
    	$limit=$count?"limit $count":"";
    	
    	$posts=array();
		$qid = $this->prepare("SELECT pid,title,unix_timestamp()-unix_timestamp(posted) as age, date_format(posted, '%a %D %b %H:%i') as postdate from paste order by posted desc, pid desc $limit");
		$qid->execute(array());
		while( $row=$qid->fetch(PDO::FETCH_ASSOC) )
			$posts[]=$row;
    	if ($posts)
			return $posts;
		else
			return false;
    }
	
    // Get follow up posts for a particular post
    public function getFollowupPosts($pid, $limit=5)
    {
		$childposts = array();

		$core = $this->prepare('SELECT pid, poster, DATE_FORMAT(posted, \'%a %D %b %H:%i\') AS postfmt FROM paste WHERE parent_pid= :p_pid ORDER BY posted LIMIT :lmt');
		$core->execute(array(
			':p_pid' => $pid,
			':lmt' => $limit
		));
		while($row = $core->fetch(PDO::FETCH_ASSOC))
			$childposts[]=$row;
		return $childposts;
    }

    // Save formatted code for displaying.
    public function saveFormatting($pid, $codefmt, $codecss)
    {
		$core = $this->prepare('UPDATE paste SET codefmt= :fmt, codecss= :css WHERE pid= :pid');
		$core->execute(array(
			':fmt' => $codefmt,
			':css' => $codecss,
			':pid' => $pid
		));
	}
	
	// Get result column $field.
	public function _f($field)
    {
    	return $this->row[$field];
    }
	
	// Get last error.
	public function get_db_error()
	{
		return $this->errorInfo();
    }
}
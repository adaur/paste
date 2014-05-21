<?php
/*
* $ID PROJECT: Paste - paste.php, v2 J.Samuel - 10/03/2013 GMT+1 (dd/mm/yy/) 
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

require_once('libraries/recaptchalib.php');
 
// Pastebin class models the pastebin data storage without getting involved in any UI generation.
class Pastebin
{
	var $conf=null;
	var $db=null;
    var $errors=array();
	
	// Constructor expects a configuration array which should contain the elements documented in config.php
	function Pastebin(&$conf)
	{
		$this->conf=&$conf;
		$this->db=new DB;	
	}
	
	// Has a 5% probability of cleaning old posts from the database
	function doGarbageCollection()
	{
		
			// Is there a limit on the number of posts?
			if ($this->conf['max_posts'])
			{
				$delete_count=$this->db->getPasteCount($this->conf['max_posts']);
				if ($delete_count>0)
				{
					$this->db->trimPastes($delete_count);
				}
			}
			
			// Delete expired posts
			$this->db->deleteExpiredPastes();
		}
	
	// Private method for validating a user-submitted username
	function _cleanUsername($name)
	{
		return trim(preg_replace('/[^A-Za-z0-9_ \-]/', '',$name));	
	}
	
	// Private method for validating a user-submitted format code
	function _cleanFormat($format)
	{
		if (!array_key_exists($format, $this->conf['geshiformats']))
			$format='text';
			
		return $format;	
	}
	
	// Private method for validating a user-submitted expiry code
	function _cleanExpiry($expiry)
	{
		if (!preg_match('/^[dmf]$/', $expiry))
			$expiry='d';
			
		return $expiry;
	}
		
	// Returns array of cookie info if present, false otherwise all cookie data is cleaned before returning.
	function extractCookie()
	{
		$data=false;
		if (isset($_COOKIE["persistName"]))
		{
			$data=array();
			
			//blow apart the cookie
			list($title,$last_format,$last_expiry)=explode('#', $_COOKIE["persistName"]);
			
			//clean and validate the cookie inputs
			$data['title']=$this->_cleanUsername($title);
			$data['last_format']=$this->_cleanFormat($last_format);
			$data['last_expiry']=$this->_cleanFormat($last_expiry);
		}
		return $data;
	}
	
	// Returns paste ID if successful.
	function doPost(&$post)
	{
		$id=0;
		global $CONF;
		global $lang;
      
      // reCAPTCHA.
      if ($this->conf['useRecaptcha']) {
         $resp = recaptcha_check_answer($this->conf['privkey'], $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
      
         if (!$resp->is_valid) {
            $this->errors[] = $lang['Error ReCaptcha'];
            return $id;
         }
      }
      
		// Validate some inputs.
		$post["title"]=$this->_cleanUsername($post["title"]);
		$post["format"]=$this->_cleanFormat($post["format"]);
		$post["expiry"]=$this->_cleanExpiry($post["expiry"]);
			
		// Set/clear the persistName cookie.
		if (isset($post["remember"]))
		{
			$value=$post["title"].'#'.$post["format"].'#'.$post['expiry'];
			
			// Set cookie if not set.
			if (!isset($_COOKIE["persistName"]) || 
				($value!=$_COOKIE["persistName"]))
				setcookie ("persistName", $value, time()+3600*24*365);  
		}
		else
		{
			// Clear cookie if set.
			if (isset($_COOKIE['persistName']))
				setcookie ('persistName', '', 0);
		}
		
		if (strlen($post['code2'])) {
			$title=preg_replace('/[^A-Za-z0-9_ \-]/', '',$post['title']);
			$title=$post['title'];
			if (strlen($title)==0)
				$title=$lang['Untitled'];
			
			$format=$post['format'];
			if (!array_key_exists($format, $this->conf['geshiformats']))
				$format='';
			
			$code=$post["code2"];
            
            if (empty($post["password"]) || $post["password"] == "") {
            	$password="EMPTY";
            }
            else {
            	$password=sha1($post["password"].$salt);
            }
			
			// Now insert..
			$parent_pid=0;
			if (isset($post["parent_pid"]))
				$parent_pid=intval($post["parent_pid"]);
				
			$id=$this->db->addPost($title,$format,$code,$parent_pid,$post["expiry"],$password);
		}
		else {
			$this->errors[]=$lang['Error Paste'];
		}
		return $id;
	}	
	
	function getPasteURL($id)
	{
		global $CONF;
		if ( isset($mod_rewrite) && $mod_rewrite == true ) { 
            return sprintf($this->conf['pid_format'], $id); 
        } else {
            return sprintf("./?paste=".$this->conf['pid_format'], $id);
        }
	}

	function redirectToPost($id)
	{
		header("Location:".$this->getPasteURL($id));	
	}

	function doDownload($pid)
	{
		$ok=false;
		$post=$this->db->getPaste($pid);
		if ($post)
		{
			// Figure out extensions.
			$ext="txt";
			switch($post['format'])
			{
			case 'bash':
			   $ext='sh';
			   break;
			case 'actionscript':
			   $ext='html';
			   break;
			case 'html4strict':
			   $ext='html';
			   break;
			case 'javascript':
			   $ext='js';
			   break;
			case 'perl':
			   $ext='pl';
			   break;
            case 'csharp':
               $ext='cs';
               break;
            case 'ruby':
               $ext='rb';
               break;
            case 'python':
               $ext='py';
			case 'sql':
			   $ext='sql';
               break;
			   case 'php':
			   case 'c':
			   case 'cpp':
			   case 'css':
			   case 'xml':
            case 'asm':
					$ext=$post['format'];
					break;
			}
			
			// Download
			header('Content-type: text/plain');
			header('Content-Disposition: attachment; filename="'.$post['title'].'.'.$ext.'"');
			echo $post['code'];
			$ok=true;
		}
		else
		{
			//not found
			header('HTTP/1.0 404 Not Found');
		}
		return $ok;
	}
	
	// Returns array of post summaries, each element has: url, title, age. parameter is a count or 0 for all
	function getRecentPosts($list=10)
	{
		global $CONF;
		global $lang;
		
		// Get raw db info.
		$posts=$this->db->getRecentPostSummary($list);
		
		// Augment with some formatting
		foreach($posts as $idx=>$post)
		{
			$age=$post['age'];
			$days=floor($age/(3600*24));
			$hours=floor($age/3600);
			$minutes=floor($age/60);
			$seconds=$age;
			
			if ($days>1)
				$age=sprintf($lang['days ago'], $days);
			elseif ($hours>0)
				$age=sprintf((($hours>1)?$lang['hours ago']:$lang['hour ago']), $hours);
			elseif ($minutes>0)
				$age=sprintf((($minutes>1)?$lang['minutes ago']:$lang['minute ago']), $minutes);
			else
				$age=sprintf((($seconds>1)?$lang['secondes ago']:$lang['seconde ago']), $seconds);
							
			$posts[$idx]['agefmt']=$age;
											
		}
		
		return $posts;		
	}

	// Get formatted post, ready for inserting into a page. Returns an array of useful information
	function getPaste($pid)
	{
		global $CONF;
		global $lang;
		
		$post=$this->db->getPaste($pid);
		if ($post)
		{
			// Show a quick reference url, title and parents.        
			$expires = ((is_null($post['expires'])) ? " (".$lang['Never Expires'].") " : (" - ".$lang['Expires on']." " . date("D, F jS @ g:ia", strtotime($post['expires']))));
			$post['posttitle']="<b>{$post['title']}</b> - ".$lang['Posted on']." {$post['postdate']} {$expires}";
			
			if ($post['parent_pid']>0)
			{
				$parent_pid=$post['parent_pid'];
				
				$parent=$this->db->getPaste($parent_pid);
				if ($parent)
				{
					$post['parent_title']=$parent['title'];
					$post['parent_url']=$this->getPasteUrl($parent_pid);
					$post['parent_postdate']=$parent['postdate'];
					$post['parent_diffurl']=$this->conf['diff_url']."$pid";
					
				}
			}
	
			// Amendments
			$post['followups']=$this->db->getFollowupPosts($pid);
			foreach($post['followups'] as $idx=>$followup)
			{
				$post['followups'][$idx]['followup_url']=$this->getPasteUrl($followup['pid']);	
			}
			
         if ($post['password'] != 'EMPTY')
            $post['downloadurl']=$this->conf['url']."?dl=$pid&pass=". $post['password'];
         else
            $post['downloadurl']=$this->conf['url']."?dl=$pid";
			
			// Store the code for later editing
			$post['editcode']=$post['code'];
	
	
			// Preprocess
			$highlight=array();
			$prefix_size=strlen($this->conf['highlight_prefix']);
			if ($prefix_size)
			{
				$lines=explode("\n",$post['editcode']);
				$post['editcode']="";
				foreach ($lines as $idx=>$line)
				{
					if (substr($line,0,$prefix_size)==$this->conf['highlight_prefix'])
					{
						$highlight[]=$idx+1;
						$line=substr($line,$prefix_size);
					}
					$post['editcode'].=$line."\n";
				}
				$post['editcode']=rtrim($post['editcode']);
			}
				
			// Get formatted version of code
			if (strlen($post['codefmt'])==0)
			{
				$geshi = new GeSHi($post['editcode'], $post['format']);
				
				$geshi->enable_classes();
				$geshi->set_header_type(GESHI_HEADER_DIV);
				$geshi->set_line_style('background: #ffffff;', 'background: #f4f4f4;');		
				if (count($highlight))
				{
					$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
					$geshi->highlight_lines_extra($highlight);
					$geshi->set_highlight_lines_extra_style('color:black;background:#FFFF88;');
				}
				else
				{
					$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS,2);
				}
				
				$post['codefmt']=$geshi->parse_code();
				$post['codecss']=$geshi->get_stylesheet();
				
				// Save it!
				$this->db->saveFormatting($pid, $post['codefmt'], $post['codecss']);
			}
			$post['pid']=$pid;
			
			$this->db->addHit($pid);
		}
		else {
			$post['codefmt']="<b>".$lang['Unknown post']."</b><br />";
		}
		return $post;
	}
	
	// Returns result of the search
	function getSearch($keywords)
	{
		global $CONF;
		global $lang;
		
		$search=$this->db->getSearch($keywords);
		
		foreach($search as $idx=>$post)
		{
			$age=$post['age'];
			$days=floor($age/(3600*24));
			$hours=floor($age/3600);
			$minutes=floor($age/60);
			$seconds=$age;
			
			if ($days>1)
				$age=sprintf($lang['days ago'], $days);
			elseif ($hours>0)
				$age=sprintf((($hours>1)?$lang['hours ago']:$lang['hour ago']), $hours);
			elseif ($minutes>0)
				$age=sprintf((($minutes>1)?$lang['minutes ago']:$lang['minute ago']), $minutes);
			else
				$age=sprintf((($seconds>1)?$lang['secondes ago']:$lang['seconde ago']), $seconds);
							
			$search[$idx]['agefmt']=$age;
											
		}
		
		return $search;
	}
	
}

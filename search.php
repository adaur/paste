<?php
/*
* $ID PROJECT: Paste - index.php, v2 J.Samuel - 10/03/2013 GMT+1 (dd/mm/yy/)
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

// Includes
require_once('includes/config.inc.php');
require_once('includes/libraries/geshi.php');
require_once('includes/diff.php');
require_once('includes/paste.php');

// Create our pastebin object
$pastebin=new Pastebin($CONF);

/// Clean up older posts 
$pastebin->doGarbageCollection();

// If we get this far, we're going to be displaying some HTML, so let's kick off here.
$page=array();

// Figure out some nice defaults.
$page['current_format']=$CONF['default_highlighter'];
$page['expiry']=$CONF['default_expiry'];
$page['remember']='';

// Add list of recent posts.
$page['recent']=$pastebin->getRecentPosts($CONF['recentposts']);

$page['title']=$lang['Search'].' - '.$CONF['sitetitle'];

//  Research
if (isset($_REQUEST["search"]))
{
	$keywords=$_REQUEST['search'];
	// Get the search.
	$page['search']=$pastebin->getSearch($keywords);
}

// HTML page output.
include('templates/'.$CONF['template'].'/header.php');
include('templates/'.$CONF['template'].'/search.php');
include('templates/'.$CONF['template'].'/footer.php');

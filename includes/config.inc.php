<?php
/*
* $ID PROJECT: Paste - config.inc.php, v2 J.Samuel - 10/03/2013 GMT+1 (dd/mm/yy/)
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
 
$CONF=array();

// Include the configration file
require_once('config.php');

// Pull in the required database class.
switch($CONF['dbsoftware']){
    case "postgresql":
        require_once('libraries/postgresql.php');
        break;
    case "mysql":
        require_once('libraries/mysql.php');
        break;
}
?>
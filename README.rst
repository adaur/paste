====================
Welcome to Paste 2.0
====================
Paste is forked from the original source pastebin.com used before it was bought.
The original source is available from the previous owner's `GitHub repository <https://github.com/lordelph/pastebin>`_

A demo of Paste is available `here on SourceForge for your convenience <http://phpaste.sourceforge.net/demo>`_

adaur: I'm just playing with Paste a little bit... follow this if you want to see what it looks like...
======================================================================


.. image:: http://i.imgur.com/8fqrIan.png

Requirements: Apache + PHP + MySQL or PostgreSQL
================================================

Installer
=========
* Create a database for PASTE.
* Upload all files to a webfolder
* Point your browser to http://yourpas.te/installation/install
* Input some settings, copy & paste the generated config into config.php, DELETE the install folder and you're ready to go.

Manual Install
==============
* Create a database for PASTE.
* Add the tables to the database (located in sql files, match the file to your DB software)
* Edit config.edit.php and rename to config.php

The configuration file is pretty well documented (config.php)
so you shouldn't have any problems with it.
  
Any bugs can be reported at:
https://sourceforge.net/p/phpaste/bugs/
or 
http://bitbucket.org/j-samuel/paste/issues/new/

You can find support on IRC by connecting to irc.collectiveirc.net in channel #PASTE

-----------------------------------------------------------------------------------------------------

===============
Changelog (2.0)
===============
* Fully designed admin panel to delete pastes, manage users & site settings
* User dashboard to manage pastes & view insights
* Ability to comment on pastes
* Trends, archive, raw, stats & search pages
* Sign up with Facebook/Twitter
* Added some more themes, including Pastebinv2 (the current pastebin.com theme)
* Added an installer to create tables (only MySQL supported at the moment) and generate a config file
	
-----------------------------------------------------------------------------------------------------

Credits
=======
* Paul Dixon (blog.dixo.net) for creating the original pastebin.com source.
* Jorge Peña (http://www.blaenkdenum.com) for making numerous changes to the older source, (archives which are now being reworked on and password protection)
* Roberto Rodríguez (roberto.rodriguez.pino@gmail.com) for PostgreSQL support.

jQuery, Twitter Bootstrap and various jQuery addons for present and future features.
Icons are provided by fontawesome.

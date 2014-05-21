<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $page['title'];?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
  	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,600,300' rel='stylesheet' type='text/css'> 
  	<link href='<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/css/chosen.css' rel='stylesheet' type="text/css">
	<link href="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/css/paste.css" rel="stylesheet" type="text/css">
	<style type="text/css"> body { padding-top: 100px; } </style>
	<link href="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/css/bootstrap-responsive.css" rel="stylesheet">
	<?php
	if (isset($page['post']['codecss'])) { 
		echo '<style type="text/css">'."\n";
		echo $page['post']['codecss'];
		echo '</style>'."\n";}
	?>
	
	<!-- JS -->
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/jquery/jquery-1.9.1-min.js"></script> 
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/jquery/jquery.jpanelmenu.min.js"></script>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/jquery/jquery.cookie.js"></script>

	<!-- IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/img/favicon.ico">
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<!-- Responsive/Mobile menu button -->
				<a href="#">
					<button type="button" class="btn btn-navbar mobile-menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</a>
			<!-- Logo -->
			<a class="brand" href="<?php echo $CONF['url']?>"><img src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/img/logo.png"></a>
			<!-- User Navigation -->
			<ul class="nav pull-right">
			<!-- User -->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="icon-user icon-white"></i> 
				<span class="hidden-phone"><?php echo $lang['Anonymous'] ?></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#"><i class="icon-user"></i> <?php echo $lang['Profile'] ?></a></li>
					<li><a href="#settings" data-toggle="modal"><i class="icon-cog"></i> <?php echo $lang['Settings'] ?></a></li>
					<li><a href="#mypastes" data-toggle="modal"><i class="icon-envelope"></i> <?php echo $lang['My Pastes'] ?></a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon-off"></i> <?php echo $lang['Logout'] ?></a></li>
				</ul>
			</li>
			</ul>
		</div>
	</div>
</div>

<div id="settings" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel"><i class="icon-cog"></i> <?php echo $lang['Settings'] ?></h3>
	</div>

	<div class="modal-body">
		<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="inputName"><i class="icon-user"></i> <?php echo $lang['Name'] ?></label>
					<div class="controls">
						<input type="text" id="inputName" placeholder="<?php echo $lang['Name'] ?>">
					</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputUsername"><i class="icon-user"></i> <?php echo $lang['Username'] ?></label>
					<div class="controls">
						<input type="text" id="inputUsername" placeholder="<?php echo $lang['Username'] ?>">
					</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputPassword"><i class="icon-key"></i> <?php echo $lang['Password'] ?></label>
					<div class="controls">
						<input type="password" id="inputPassword" placeholder="<?php echo $lang['Password'] ?>">
					</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputRepeat"><i class="icon-key"></i> <?php echo $lang['Repeat Password'] ?></label>
					<div class="controls">
						<input type="password" id="inputRepeat" placeholder="<?php echo $lang['Password'] ?>">
					</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail"><i class="icon-envelope"></i> <?php echo $lang['Email'] ?></label>
					<div class="controls">
						<input type="text" id="inputEmail" placeholder="Email">
					</div>
			</div>		 
	</div>

			<div class="modal-footer">
				<button class="btn btn-primary"><?php echo $lang['Save changes'] ?></button>
				<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $lang['Close'] ?></button>
		</form>
			</div>

</div> 

<!-- PASTE will eventually include this feature ;)
	<div id="messages" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="messages" aria-hidden="true">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="messages"><i class="icon-comment"></i> Messages</h3>
		</div>

		<div class="modal-body no-padding">
		
			<div class="list-widget">

				<div class="item">
					<small class="pull-right">date would be here</small>
					<h3><i class="icon-user"></i> username</h3>
					<p>thismessage</p>
				</div>

			</div>

		</div>

		<div class="modal-footer">

			<a href="#newmessage" class="btn btn-primary" data-dismiss="modal" data-toggle="modal">New mesaage</a>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

		</div>

	</div>
	
	<div id="newmessage" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="newmessages" aria-hidden="true">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="newmessages"><i class="icon-comment"></i> New Message</h3>
		</div>

		<div class="modal-body">
			<div class="control-group">
				<label class="control-label" for="inputName"> </label>
				<div class="controls">
					<input type="text" id="inputName" placeholder="Recipient">
				</div>
			</div>
			
			<div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">

				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
					<ul class="dropdown-menu">
					</ul>
				</div>

				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
					<li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
					<li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
					</ul>
				</div>

				<div class="btn-group">
					<a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
					<a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
					<a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
					<a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
				</div>
				
				<div class="btn-group">
					<a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
					<input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
				</div>

			</div>

			<div id="sendmessage"></div>

		</div>
		<div class="modal-footer">

			<button class="btn btn-primary">Send Message</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

		</div>

	</div>
	// -->

<div class="container">
	<div class="navbar navbar-inverse" id="nav">
		<div class="navbar-inner">
			<ul class="nav">
				<li><a href="<?php echo $CONF['url'];?>"><i class="icon-paste"></i> <?php echo $lang['Submit'] ?></a></li>
				<li><?php if ( $mod_rewrite == true ) { echo '<a href="'. $CONF['url'] .'search">'; } else { echo '<a href="'. $CONF['url'] .'search.php">'; } ?><i class="icon-search"></i> <?php echo $lang['Search'] ?></a></li>
				<li><?php if ( $mod_rewrite == true ) { echo '<a href="'. $CONF['url'] .'trending">'; } else { echo '<a href="'. $CONF['url'] .'trends.php">'; } ?><i class="icon-bar-chart"></i> <?php echo $lang['Trending'] ?></a></li>
				<li><?php if ( $mod_rewrite == true ) { echo '<a href="'. $CONF['url'] .'archive">'; } else { echo '<a href="'. $CONF['url'] .'archive.php">'; } ?><i class="icon-archive"></i> <?php echo $lang['Public Archive'] ?></a></li>
				<!-- who knows what we'll add here, docs? faq?
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-blah"></i> FAQ <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="icon-blah"></i> Nothing to see here</a></li>
						</ul>
				</li> // -->

				<!-- we plan on adding image pastes too
				<li><a href="#"><i class="icon-picture"></i> Images</a></li>//-->

			</ul>
			
			<form class="navbar-search pull-right" method="get">
				<input type="text" class="search-query typeahead" name="search" placeholder="Search">
			</form>
		</div>

	</div>
<!-- End container -->
</div>
<!-- Footer -->
	<footer class="footer">
      <div class="container">
        <p>&copy; <?php echo date("Y") . ' ' . htmlspecialchars($CONF['url']); // You can change this, but it would be lovely if you'd give us your support by keeping our link here :)?><br />
		<?php echo $lang['Powered by'] ?> <a href="http://sourceforge.net/projects/phpaste/">PASTE</a> <a href="http://php.net/">(PHP)</a>. <?php echo $lang['Frontend'] ?> <a href="http://jquery.com/"><?php echo $lang['jQuery'] ?></a> &amp; <a href="https://github.com/twbs/bootstrap"><?php echo $lang['Twitter Bootstrap'] ?></a>.</p>
      </div>
	</footer>
</body>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/jquery/jquery.hotkeys.js"></script>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/jquery/jquery-ui-1.10.2.custom.min.js"></script>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/jquery/jquery.pajinate.js"></script>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/bootstrap/bootstrap.min.js"></script>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/jquery/jquery.easing.min.js"></script>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/jquery/jquery.chosen.min.js"></script>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/js/paste.js"></script>
</html>
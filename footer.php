<div id="footer">
	<div class="footerlinks">
		<br>
		<ul>
		<li> <a href="http://harvardpolitics.com/about/">About</a> </li>
		<li> <a href="http://harvardpolitics.com/advertising-in-the-hpr/">Advertising</a> </li>
		<li> <a href="http://harvardpolitics.com/archives/">Archives</a> </li>
		<li> <a href="http://harvardpolitics.com/comp/">Comp</a> </li>
		<li> <a href="http://harvardpolitics.com/contact-us/">Contact Us</a> </li>
		<li> <a href="http://harvardpolitics.com/donate/">Donate</a> </li>
		<li> <a href="http://harvardpolitics.com/masthead/">Masthead</a> </li>
		<!-- Writer log-in -->
		<? if (is_user_logged_in())
		{ ?>
		<li> <a href="<? echo admin_url(); ?>">Dashboard</a> </li>
		<li> <a href="<? echo wp_logout_url(); ?>">Logout</a> </li>
		<? }
		else { ?>
		<li><a href="http://harvardpolitics.com/wp-admin/">Log In</a></li>
		<? } ?>

	</ul>
		<br>
	</div>

	<div id="copyright">
		&copy; <?php _e('Copyright', 'wpzoom') ?> <?php echo date("Y"); ?> &mdash;
		<a href="<?php echo get_option('home'); ?>/" class="on">
			<?php bloginfo('name'); ?></a>.
			<?php _e('All Rights Reserved', 'wpzoom') ?>
	</div>

</div> <!-- /#footer -->



</body>
</html>

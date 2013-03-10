<?php
global $current_user;
get_currentuserinfo();
?>
			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

			<?php get_sidebar( 'secondary' ); // Loads the sidebar-secondary.php template. ?>

		</div><!-- #main -->

		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>

		<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

	</div><!-- #container -->

	<?php if( is_page_template( 'page-template-home.php' ) ) get_template_part( 'modals' ); // Load modals.php ?>
	
	<div class="hidden"><?php cd_choose_avatar( $current_user->ID ); ?></div>
	
	<?php wp_footer(); ?>
	
	<script type="text/javascript">
	  var uvOptions = {};
	  (function() {
	    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
	    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/u9wFFHubVFFLBVve28tg.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
	  })();
	</script>

</body>
</html>
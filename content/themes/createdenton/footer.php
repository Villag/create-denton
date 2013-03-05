<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
			</div><!-- #main .wrapper -->
			
		</div><!-- #page -->
		
		<?php if( is_page_template( 'page-template-home.php' ) ) get_template_part( 'modals' ); // Load modals.php ?>
		
		<div class="hidden"><?php cd_choose_avatar( $current_user->ID ); ?></div>
		
		<?php wp_footer(); ?>
		<?php cd_first_timer(); ?>
		
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
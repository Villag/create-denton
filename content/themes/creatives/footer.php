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
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'twentytwelve_credits' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if( is_user_logged_in() ): ?>
<div class="modal hide fade in" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="edit-profile-label" aria-hidden="true" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="edit-profile-label">Edit Profile</h3>
	</div>
	<div class="modal-body">
		<?php echo do_shortcode( '[gravityform id="2" name="Profile" title="false" ajax="true"]' ); ?>
	</div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
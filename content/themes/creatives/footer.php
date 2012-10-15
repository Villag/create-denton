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
<?php else: ?>
<div class="modal hide fade in" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" data-width="760">
	
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>wp/wp-login.php" method="post" class="form-horizontal">
		
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="modal-login-label">Login</h3>
		</div>
		
		<div class="modal-body">
			
			<?php do_action( 'wordpress_social_login' ); ?>


			<div class="control-group">
				<label class="control-label" for="user_login">Email</label>
				<div class="controls">
					<input class="input-medium" value="" tabindex="10" id="user_login" name="log" type="text" placeholder="email">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="user_pass">Password</label>
				<div class="controls">
					<input class="input-medium" value="" tabindex="20" id="user_pass" name="pwd" type="password" placeholder="password">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<label class="checkbox"> <input type="checkbox" tabindex="90"> Remember me </label>
				</div>
			</div>

		</div>

		<div class="modal-footer">
			<div class="control-group">
				<div class="controls">
					<button type="button" class="btn" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Login</button>
				</div>
			</div>
		</div>
		
	</form>
	
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
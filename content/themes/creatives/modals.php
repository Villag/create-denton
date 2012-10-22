<?php if( is_user_logged_in() ): ?>

<div class="hide modal fade" role="dialog" aria-hidden="true" tabindex="-1" id="modal-edit-profile" aria-labelledby="edit-profile-label" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="edit-profile-label">Edit Profile</h3>
	</div>
	<div class="modal-body">
		<?php echo do_shortcode( '[gravityform id="2" name="Profile" title="false" ajax="true"]' ); ?>
	</div>
</div>

<?php else: // If user is not logged in ?>
	
<div class="hide modal fade" role="dialog" aria-hidden="true" tabindex="-1" id="modal-login" >

	<?php wp_login_form(); ?>
	
</div>

<?php endif; ?>

<?php get_template_part( 'card-back' ); // Loads card-back.php ?>

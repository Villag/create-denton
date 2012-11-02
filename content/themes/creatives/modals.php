<?php if( is_user_logged_in() ): ?>

<div class="reveal-modal" role="dialog" aria-hidden="true" tabindex="-1" id="edit-profile" aria-labelledby="edit-profile-label" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="edit-profile-label">Edit Profile</h3>
	</div>
	<div class="modal-body">
		<?php echo do_shortcode( '[gravityform id="2" name="Profile" title="false" ajax="true"]' ); ?>
	</div>
	<a class="close-reveal-modal">×</a>
</div>

<?php else: // If user is not logged in ?>
	
<div class="reveal-modal" role="dialog" aria-hidden="true" tabindex="-1" id="login" >

	<div class="modal-header">
		
		<a class="close-reveal-modal">×</a>
				
	</div>
	
	<div class="modal-body">
		
		<div class="row-fluid">
			
			<div class="span12">
				 <?php do_action('oa_social_login'); ?>
			</div>
		</div>
	
		<div class="row-fluid">
			
			<div class="span6">
				<h2>Login</h2>
				<?php wp_login_form( array( 'redirect' => get_home_url(), 'label_username' => __( 'Email' ) )); ?>		
			</div>
			
			<div class="span6">
				<h2>Sign Up</h2>
				<?php echo do_shortcode('[gravityform id=1 title=false description=false]'); ?>			
			</div>
			
		</div><!-- .row-fluid -->
		
	</div>
		
</div><!-- .modal -->

<?php endif; ?>

<div class="reveal-modal" id="about" >

	<?php $page_id = 47; $page_data = get_page( $page_id ); ?>
	
	<?php //echo stc_get_connect_button('login'); ?>
	
	<div class="modal-header">
		
		<a class="close-reveal-modal">×</a>
		
		<h3><?php echo $page_data->post_title; ?></h3>
		
	</div>
	
	<div class="modal-body">
	
		<div class="row-fluid">
			
			<div class="span12">
	
			<?php echo apply_filters('the_content', $page_data->post_content); ?>
				
			</div>
			
		</div><!-- .row-fluid -->
		
	</div>
	
</div><!-- .modal -->

<div class="reveal-modal" id="contact-user" >
	
	<div class="modal-header">
		
		<a class="close-reveal-modal">×</a>
		
		<h3>Contact User</h3>
		
	</div>
	
	<div class="modal-body">
	
		<div class="row-fluid">
			
			<div class="span12">
	
			<?php echo do_shortcode('[gravityform id=4 title=false description=false]'); ?>			
				
			</div>
			
		</div><!-- .row-fluid -->
		
	</div>
	
</div><!-- .modal -->


<?php if( !is_page_template( 'page-template-launch.php' ) ){ get_template_part( 'card-back' ); } // Loads card-back.php ?>

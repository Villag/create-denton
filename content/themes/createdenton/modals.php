<?php if( !is_user_logged_in() ): ?>

<div class="reveal-modal" role="dialog" aria-hidden="true" tabindex="-1" id="login" >

	<div class="modal-header">
		
		<a class="close-reveal-modal">×</a>
		
		<h3>Login</h3>
				
	</div>
	
	<div class="modal-body">
	
		<div class="row-fluid">
			
			<div class="span6">
				<?php do_action('oa_social_login'); ?>
			</div>
			
			<div class="span6">
     			<?php wp_login_form( array( 'redirect' => get_home_url(), 'label_username' => __( 'Email' ) )); ?>    
			</div>
			
		</div><!-- .row-fluid -->
		
	</div>
		
</div><!-- .modal -->

<div class="reveal-modal" role="dialog" aria-hidden="true" tabindex="-1" id="sign-up" >

	<div class="modal-header">
		
		<a class="close-reveal-modal">×</a>
		
		<h3>Sign Up</h3>
				
	</div>
	
	<div class="modal-body">
	
		<div class="row-fluid">
			
			<div class="span6">
				<?php do_action('oa_social_login'); ?>
			</div>
			
			<div class="span6">
				<?php echo do_shortcode('[gravityform name="Sign Up" title=false description=false]'); ?>			
			</div>
			
		</div><!-- .row-fluid -->
		
	</div>
		
</div><!-- .modal -->

<?php endif; ?>

<div class="reveal-modal" id="about" >

	<?php $page_data = get_page_by_path('about'); ?>
		
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

<?php get_template_part( 'card-back' ); // Loads card-back.php ?>
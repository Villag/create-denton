<?php
if( is_user_logged_in() ):
global $current_user; 
?>

<div class="reveal-modal" role="dialog" aria-hidden="true" tabindex="-1" id="edit-profile" aria-labelledby="edit-profile-label" data-width="760">
	<div class="modal-header">
		<a class="close-reveal-modal">×</a>
		<h3 id="edit-profile-label">Edit Profile</h3>
	</div>
	<div class="modal-body">
		
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				var avatar_local = $('#avatar-local');
				var avatar_social = $('#avatar-social');
				var avatar_gravatar = $('#avatar-gravatar');
				
				$('input:radio[name="input_11"]').change( function(){
					$(this).parent().siblings().removeClass('selected');
					$(this).parent().addClass('selected');				
				});

				$('input:radio[name="input_11"][checked]').each( function() {
					$(this).parent().siblings().removeClass('selected');
					$(this).parent().addClass('selected');
				});
					
				if(avatar_local.length > 0) {
					$('input[value="avatar_local"]').next().prepend(avatar_local);
				} else {
					$('input[value="avatar_local"]').parent().hide();
				}
						
				if(avatar_social.length > 0) {
					$('input[value="avatar_social"]').next().prepend(avatar_social);
				} else {
					$('input[value="avatar_social"]').parent().hide();
				}
				
				if(avatar_gravatar.length > 0) {
					$('input[value="avatar_gravatar"]').next().prepend(avatar_gravatar);
				} else {
					$('input[value="avatar_gravatar"]').parent().hide();
				}
				
			});
		</script>	
		<style>
			.gform_wrapper li.gfield.gf_list_4col ul.gfield_radio li {
				font-size: 12px;
				line-height: 14px;
				margin: 0 1% 0 0 !important;
				padding: 4px !important;
				width: 22% !important;
			}
			.gform_wrapper li.gfield.gf_list_4col ul.gfield_radio li label {
				margin: 0;
			}
			.gform_wrapper li.avatars li {
				display: block;
				line-height: 20px;
				border: 1px solid #DDD;
				-webkit-border-radius: 4px;
				-moz-border-radius: 4px;
				border-radius: 4px;
				-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
				-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.055);
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
				-webkit-transition: all .2s ease-in-out;
				-moz-transition: all .2s ease-in-out;
				-o-transition: all .2s ease-in-out;
				transition: all .2s ease-in-out;
			}
			.gform_wrapper li.selected {
				background: #ffc;
				font-weight: normal;
			}
			.gform_wrapper li.thumbnail {
				margin: 0 0 5px 0;
				padding: 4px !important;
			}
			.gform_wrapper input[type="radio"] {
				display: none;
			}
		</style>	
		<!--<img src="<?php echo get_avatar_url( get_avatar( $current_user->ID, 150 ) ); ?>" class="pull-right thumbnail">-->
		
		<?php cd_choose_avatar( $current_user->ID ); ?>

		<?php get_sidebar( 'profile' ); ?>

		<?php //echo do_shortcode( '[gravityform id="2" name="Profile" title="false" ajax="true"]' ); ?>
	</div>
	<a class="close-reveal-modal">×</a>
</div>

<?php else: // If user is not logged in ?>
	
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

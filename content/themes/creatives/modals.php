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

	<?php //echo stc_get_connect_button('login'); ?>
	
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
	
	<a class="close-reveal-modal">×</a>
	
</div><!-- .modal -->

<?php endif; ?>

<div class="reveal-modal" role="dialog" aria-hidden="true" tabindex="-1" id="about" >

	<?php //echo stc_get_connect_button('login'); ?>
	
	<div class="row-fluid">
		
		<div class="span12">

<?php 
$page_id = 47; // 123 should be replaced with a specific Page's id from your site, which you can find by mousing over the link to edit that Page on the Manage Pages admin page. The id will be embedded in the query string of the URL, e.g. page.php?action=edit&post=123.

$page_data = get_page( $page_id ); // You must pass in a variable to the get_page function. If you pass in a value (e.g. get_page ( 123 ); ), WordPress will generate an error. By default, this will return an object.

echo '<h3>'. $page_data->post_title .'</h3>';// echo the title

echo apply_filters('the_content', $page_data->post_content); // echo the content and retain Wordpress filters such as paragraph tags. Origin from: http://wordpress.org/support/topic/get_pagepost-and-no-paragraphs-problem
?>
		</div>
		
	</div><!-- .row-fluid -->
	
	<a class="close-reveal-modal">×</a>
	
</div><!-- .modal -->


<?php if( !is_page_template( 'page-template-launch.php' ) ){ get_template_part( 'card-back' ); } // Loads card-back.php ?>

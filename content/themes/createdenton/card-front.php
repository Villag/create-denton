<?php
// Loop through the users and display randomly
$users = get_users();
$randomize_users = (array)$users;
shuffle( $randomize_users );
foreach( $randomize_users as $user ) {

	global $wp_query, $current_user;
	$user_info = get_userdata( $user->ID );
	$all_meta_for_user = get_user_meta( $user->ID );
	$curauth = $wp_query->get_queried_object();

	$user_type = strtolower( get_user_meta( $user->ID, 'user_primary_job', true ) );
	$user_type = preg_replace("![^a-z0-9]+!i", "-", $user_type );

	$username = strtolower( $user_info->user_login );
	$username = preg_replace("![^a-z0-9]+!i", "-", $username );
			
	if ( !cd_is_valid_user( $user->ID ) ) continue; ?>
	
	<li class="item vcard person <?php echo $user_type; if( $current_user->ID == $user->ID ) echo ' current-user'; ?>">
		<a class="card" href="#" data-reveal-id="<?php echo $user->ID; ?>" data-animation="fade" data-animationSpeed="12000">
			
			<img src="<?php echo cd_get_avatar( $user->ID ); ?>" class="avatar" height="150" width="150" alt="<?php echo get_user_meta( $user->ID, 'first_name', true ); ?> <?php echo get_user_meta( $user->ID, 'last_name', true ); ?>">

			<header class="n brief" title="Name">
				<span class="fn" itemprop="name">
					<span class="given-name"><?php echo get_user_meta( $user->ID, 'first_name', true ); ?></span>
					<span class="family-name"><?php echo get_user_meta( $user->ID, 'last_name', true ); ?></span>
				</span> <!--/ .fn -->
				<div class="primary-job"><?php echo get_user_meta( $user->ID, 'user_primary_job', true ); ?></div>
			</header> <!--/ .n -->
		</a><!-- .card -->
				
	</li><!-- .card -->

<?php

}
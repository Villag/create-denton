<?php
$users = get_users();
foreach ( $users as $user ) {
	global $wp_query;
	$user_info = get_userdata( $user->ID );
	$all_meta_for_user = get_user_meta( $user->ID );
	$curauth = $wp_query->get_queried_object();
	
	$user_type = strtolower( get_user_meta( $user->ID, 'Primary Job', true ) );
	$user_type = preg_replace("![^a-z0-9]+!i", "-", $user_type );
	
	$username = strtolower( $user_info->user_login );
	$username = preg_replace("![^a-z0-9]+!i", "-", $username );
	
	if ( !cd_is_valid_user( $user->ID ) ) continue; ?>
	
	<li class="item vcard person <?php echo $user_type; ?>" data-type="<?php echo $user_type; ?>">
		
		<span class="dog-ear-cat-1"></span>
		
		<a class="card" href="#<?php echo $username; ?>" role="button" data-toggle="modal">
			<?php echo get_avatar( $user->ID, '150', get_stylesheet_directory_uri(). '/images/default_avatar.png', $user->display_name ); ?>
			<header class="n brief" title="Name">
				<span class="fn" itemprop="name">
					<span class="given-name"><?php echo get_user_meta( $user->ID, 'first_name', true ); ?></span>
					<span class="family-name"><?php echo get_user_meta( $user->ID, 'last_name', true ); ?></span>
				</span> <!--/ .fn -->
				<div class="primary-job"><?php echo get_user_meta( $user->ID, 'Primary Job', true ); ?></div>
			</header> <!--/ .n -->
		</a><!-- .card -->
				
	</li><!-- .card -->

<?php } ?>
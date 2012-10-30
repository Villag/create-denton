<?php

// Get the gravatar URL
// source: http://wordpress.stackexchange.com/questions/46904/how-to-get-gravatar-url-alone
function cd_get_gravatar_url( $email ) {
    $hash = md5( strtolower( trim ( $email ) ) );
	$default = urlencode( get_stylesheet_directory_uri() .'/images/default_avatar.png' );
    return 'http://gravatar.com/avatar/' . $hash .'?size=150&default='. $default;
}

// Function to display the custom-sized gravatar
function cd_gravatar_timthumb($email, $width, $height, $class) {
    $custom = get_stylesheet_directory_uri() . "/timthumb.php?src=". cd_get_gravatar_url( $email ) ."&w=". $width ."&h=". $height ."&zc=1&a=c&f=2";
    echo "<img src='" . $custom . "' class='". $class ."' alt='avatar' />";
}
// Loop through the users and display randomly
$users = get_users();
$randomize_users = (array)$users;
shuffle( $randomize_users );
foreach( $randomize_users as $user ) {

	global $wp_query;
	$user_info = get_userdata( $user->ID );
	$all_meta_for_user = get_user_meta( $user->ID );
	$curauth = $wp_query->get_queried_object();

	$user_type = strtolower( get_user_meta( $user->ID, 'Primary Job', true ) );
	$user_type = preg_replace("![^a-z0-9]+!i", "-", $user_type );
	
	//if ( !cd_is_valid_user( $user->ID ) ) continue; ?>
	
	<li class="item vcard person <?php echo $user_type; ?>">
		<a class="card" href="#<?php echo cd_clean_username( $user->ID ); ?>" role="button" data-toggle="modal">
			<?php cd_gravatar_timthumb( $user->user_email, 150, 150, 'avatar' ); ?>				
			<header class="n brief" title="Name">
				<span class="fn" itemprop="name">
					<span class="given-name"><?php echo get_user_meta( $user->ID, 'first_name', true ); ?></span>
					<span class="family-name"><?php echo get_user_meta( $user->ID, 'last_name', true ); ?></span>
				</span> <!--/ .fn -->
				<div class="primary-job"><?php echo get_user_meta( $user->ID, 'Primary Job', true ); ?></div>
			</header> <!--/ .n -->
		</a><!-- .card -->
				
	</li><!-- .card -->

<?php

}
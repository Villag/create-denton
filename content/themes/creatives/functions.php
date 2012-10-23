<?php

// Check user for IP and display launch screen if not listed
add_action( 'template_redirect', 'cd_launch_check', 11 );

// Load our JS and CSS files
add_action( 'wp_enqueue_scripts', 'cd_load_scripts', 11 );

// After user registration, login user
add_action( 'gform_user_registered', 'pi_gravity_registration_autologin', 10, 4 );

/**
 * Queue up all of our JS and CSS for loading in the correct
 * order and location within templates.
 */
function cd_load_scripts() {
	
	// Dequeue scripts/styles loaded by the parent theme
	wp_dequeue_script( 'twentytwelve-navigation' );
	wp_dequeue_style( 'twentytwelve-fonts' );
	
	// Queue JS
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() .'/js/modernizr.2.5.3.min.js' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-masonary', get_stylesheet_directory_uri() .'/js/jquery.masonry.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-easing', get_stylesheet_directory_uri() .'/js/jquery.easing.1.3.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'blur', get_stylesheet_directory_uri() .'/js/blur.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'app', get_stylesheet_directory_uri() .'/js/app.js', array( 'jquery' ), '1.0', true );
}

/**
 * Auto login after registration.
 */
function pi_gravity_registration_autologin( $user_id, $user_config, $entry, $password ) {
	$user = get_userdata( $user_id );
	$user_login = $user->user_login;
	$user_password = $password;

    wp_signon( array(
		'user_login'	=> $user_login,
		'user_password'	=> $user_password,
		'remember'		=> false
    ) );
}

/**
 * Checks if the user is valid and returns boolean.
 * 
 * A valid user has a first name, last name, primary job, and email address.
 */
function cd_is_valid_user( $user_id ) {
	$user_data		= get_userdata( $user_id );
	$email			= $user_data->user_email;
	
	$user_meta		= get_user_meta( $user_id );
	$first_name		= $user_meta['first_name'][0];
	$last_name		= $user_meta['last_name'][0];
	$primary_job	= $user_meta['Primary Job'][0];
	
	$errors = array();
	
	if ( $email == '' )
		$errors[] = 'email';

	if ( !$first_name )
		$errors[] = 'first name';

	if ( !$last_name )
		$errors[] = 'last name';
		
	if ( !$primary_job )
		$errors[] = 'primary job';
		
	if ( !$email || !$first_name || !$last_name || !$primary_job )
		return false;
	
	return true;
}

/**
 * Displays the errors a user has
 * (i.e. missing data required to be a valid user)
 */
function cd_user_errors( $user_id ) {
	$user_data		= get_userdata( $user_id );
	$email			= $user_data->user_email;
	
	$user_meta		= get_user_meta( $user_id );
	$first_name		= $user_meta['first_name'][0];
	$last_name		= $user_meta['last_name'][0];
	$primary_job	= $user_meta['Primary Job'][0];
	
	$errors = array();
	
	if ( $email == '' )
		$errors[] = 'email';

	if ( !$first_name )
		$errors[] = 'first name';

	if ( !$last_name )
		$errors[] = 'last name';
		
	if ( !$primary_job )
		$errors[] = 'primary job';
	
	$output = implode( ', ', $errors );
	
	return $output;
}

/**
 * Use the launch template if the user is not local (on MAMP)
 * or if the user is not on given IP addresses.
 */
function cd_launch_check() {
	
	// If this is not local dev, show the launch page
	if ( defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV == false ) {
		include ( STYLESHEETPATH . '/page-template-launch.php' );
		exit;
	}

}

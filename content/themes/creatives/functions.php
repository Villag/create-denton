<?php

add_action( 'wp_enqueue_scripts', 'create_load_scripts' );

add_action( 'gform_user_registered', 'pi_gravity_registration_autologin', 10, 4 );

function create_load_scripts() {
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() .'/js/modernizr.2.5.3.min.js' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-easing', get_stylesheet_directory_uri() .'/js/jquery.easing.1.3.js', array( 'jquery' ) );
	wp_enqueue_script( 'quicksand', get_stylesheet_directory_uri() .'/js/jquery.quicksand.js', array( 'jquery' ) );
	wp_enqueue_script( 'app', get_stylesheet_directory_uri() .'/js/app.js', array( 'jquery' ) );
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

function cd_is_valid_user( $user_id ) {
	$user_data		= get_userdata( $user_id );
	$email			= $user_data->user_email;
	
	$user_meta		= get_user_meta( $user_id );
	$first_name		= $user_meta['first_name'][0];
	$last_name		= $user_meta['last_name'][0];
	$primary_job	= $user_meta['Primary Job'][0];
	
	$errors = array();
	
	if ( !$email )
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

function cd_user_errors( $user_id ) {
	$user_data		= get_userdata( $user_id );
	$email			= $user_data->user_email;
	
	$user_meta		= get_user_meta( $user_id );
	$first_name		= $user_meta['first_name'][0];
	$last_name		= $user_meta['last_name'][0];
	$primary_job	= $user_meta['Primary Job'][0];
	
	$errors = array();
	
	if ( !$email )
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
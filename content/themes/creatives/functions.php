<?php

add_action( 'wp_enqueue_scripts', 'create_load_scripts' );

add_action( 'gform_user_registered', 'pi_gravity_registration_autologin', 10, 4 );

function create_load_scripts() {
	wp_enqueue_script( 'jquery' );
	//wp_enqueue_script( 'jquery-ui-core' );
	//wp_enqueue_script( 'jquery-ui-effects-core', get_stylesheet_directory_uri() .'/js/jquery-ui-1.8.24.custom.min.js', array( 'jquery-ui-core' ) );
	//wp_enqueue_script( 'jquery-flip', get_stylesheet_directory_uri() .'/js/jquery.flip.min.js', array( 'jquery-ui-effects-core' ) );
	//wp_enqueue_script( 'app', get_stylesheet_directory_uri() .'/js/app.js', array( 'jquery-flip' ) );
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
<?php

/* Load the core theme framework. */
require_once( trailingslashit( TEMPLATEPATH ) . 'library/hybrid.php' );
$theme = new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'cd_theme_setup' );

/**
 * Theme setup function. This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 1.0
 */
function cd_theme_setup() {

	// Add support for framework features
	add_theme_support( 'hybrid-core-menus', array( 'primary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'profile' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-seo' );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'hybrid-core-deprecated' );

	// Load our JS and CSS files
	add_action( 'wp_enqueue_scripts', 'cd_load_scripts', 11 );

}

/**
 * Queue up all of our JS and CSS for loading in the correct
 * order and location within templates.
 */
function cd_load_scripts() {

	// Dequeue scripts/styles loaded by the parent theme
	wp_dequeue_script( 'twentytwelve-navigation' );
	wp_dequeue_style( 'twentytwelve-fonts' );
	
	// Queue CSS
	wp_enqueue_style( 'style',				get_stylesheet_directory_uri() .'/style.css' );
	
	// Queue JS
	// Load Modernizr into the HEAD, before any other scripts
	wp_enqueue_script( 'modernizr',			get_stylesheet_directory_uri() .'/js/modernizr.2.5.3.min.js',		false, '1.0', false );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'isotope',			get_stylesheet_directory_uri() .'/js/jquery.isotope.min.js',		array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'foundation',		get_stylesheet_directory_uri() .'/js/foundation.min.js',			array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'app',				get_stylesheet_directory_uri() .'/js/app.js',						array( 'jquery' ), '1.0', true );
}
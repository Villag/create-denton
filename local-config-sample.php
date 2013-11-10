<?php

define( 'DB_NAME',			'devdal1_creatives' );
define( 'DB_USER',			'devdal1_crea8iv' );
define( 'DB_PASSWORD',		'_J,{glf1_)OF' );
define( 'DB_HOST',			'184.173.232.56' );

/**
 * Forces new hostsnames
 *
 *         dev.example.local
 * maintenance.example.local
 *     staging.example.local
 *  production.example.local
 *
 * @see wp-config.php
 * @link http://codex.wordpress.org/Editing_wp-config.php
 */
define( 'ENV_DOMAIN',			'local.createdenton.com' );
define( 'PRODUCTION_DOMAIN',	'createdenton.com' );
define( 'DOMAIN_CURRENT_SITE',	ENV_DOMAIN );
define( 'WP_HOME',				'http://'. ENV_DOMAIN );
define( 'WP_SITEURL',			'http://'. ENV_DOMAIN .'/wp' );

/**
 * Enabled WP_DEBUG mode
 * @see WP_DEBUG
 * @link http://codex.wordpress.org/Debugging_in_WordPress#WP_DEBUG
 */
define( 'WP_DEBUG',			true );

/**
 * Enable Debug logging to the /content/debug.log file
 * @see SCRIPT_DEBUG
 * @link http://codex.wordpress.org/Debugging_in_WordPress#WP_DEBUG_LOG
 */
define( 'WP_DEBUG_LOG',		true );

/**
 * Enable display of errors and warnings
 * @see SCRIPT_DEBUG
 * @link http://codex.wordpress.org/Debugging_in_WordPress#WP_DEBUG_DISPLAY
 */
define( 'WP_DEBUG_DISPLAY',	true );
@ini_set( 'display_errors',	1 );

/**
 * Saves the database queries to a array
 * @see SCRIPT_DEBUG
 * @link http://codex.wordpress.org/Debugging_in_WordPress#SAVEQUERIES
 */
define( 'SAVEQUERIES',		true );

/**
 * Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
 * @see SCRIPT_DEBUG
 * @link http://codex.wordpress.org/Debugging_in_WordPress#SCRIPT_DEBUG
 */
define( 'SCRIPT_DEBUG',		true );

/**
 * In local environments, allow editing of themes and plugins
 */
define( 'DISALLOW_FILE_MODS', false );
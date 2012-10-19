<?php
/**
 * Template Name: Home
 */
add_action( 'wp_enqueue_scripts', 'cd_launch_scripts' );
function cd_launch_scripts() {
	wp_enqueue_script( 'vegas', get_stylesheet_directory_uri() .'/js/jquery.vegas.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'launch', get_stylesheet_directory_uri() .'/js/launch.js', array( 'jquery' ), '1.0', true );
}
?>
<!DOCTYPE html>
<!--[if IE 7 | IE 8]>
<html class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site container-fluid">
	<header id="masthead" class="site-header" role="banner">
		<hgroup class="assistive-text">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
		
	<div id="primary" class="site-content">
		
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
			<div class="row-fluid">

				<style>
					body {
						background: #000;
						font-size: 15px;
						text-shadow: 1px 1px 1px rgba(0,0,0,.5);
					}
					#interested {
						color: #fff;
					}
					#interested form {
						overflow: hidden;
					}
					#interested label {
						display: inline-block;
						margin-bottom: 5px;
						width: auto;
					}
					#interested .gform_body,
					#interested .gform_footer {
						clear: none;
						padding: 0;
						float: left;
					}
					#interested input.medium {
						width: 140px;
					}
					#interested .button {
						margin: 7px 0 0 5px;
					}
					
					.button {
					  display: inline-block;
					  *display: inline;
					  padding: 4px 14px;
					  margin-bottom: 0;
					  *margin-left: .3em;
					  font-size: 14px;
					  line-height: 20px;
					  *line-height: 20px;
					  color: #333333;
					  text-align: center;
					  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
					  vertical-align: middle;
					  cursor: pointer;
					  background-color: #f5f5f5;
					  *background-color: #e6e6e6;
					  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
					  background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
					  background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
					  background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
					  background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
					  background-repeat: repeat-x;
					  border: 1px solid #bbbbbb;
					  *border: 0;
					  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
					  border-color: #e6e6e6 #e6e6e6 #bfbfbf;
					  border-bottom-color: #a2a2a2;
					  -webkit-border-radius: 4px;
					     -moz-border-radius: 4px;
					          border-radius: 4px;
					  filter: progid:dximagetransform.microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
					  filter: progid:dximagetransform.microsoft.gradient(enabled=false);
					  *zoom: 1;
					  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
					     -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
					          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
					}
					
					.button:hover,
					.button:active,
					.button.active,
					.button.disabled,
					.button[disabled] {
					  color: #333333;
					  background-color: #e6e6e6;
					  *background-color: #d9d9d9;
					}
					
					.button:active,
					.button.active {
					  background-color: #cccccc \9;
					}
					
					.button:first-child {
					  *margin-left: 0;
					}
					
					.button:hover {
					  color: #333333;
					  text-decoration: none;
					  background-color: #e6e6e6;
					  *background-color: #d9d9d9;
					  /* Buttons in IE7 don't get borders, so darken on hover */
					
					  background-position: 0 -15px;
					  -webkit-transition: background-position 0.1s linear;
					     -moz-transition: background-position 0.1s linear;
					       -o-transition: background-position 0.1s linear;
					          transition: background-position 0.1s linear;
					}
					
					.button:focus {
					  outline: thin dotted #333;
					  outline: 5px auto -webkit-focus-ring-color;
					  outline-offset: -2px;
					}
					
					.button.active,
					.button:active {
					  background-color: #e6e6e6;
					  background-color: #d9d9d9 \9;
					  background-image: none;
					  outline: 0;
					  -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
					     -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
					          box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
					}

					.vegas-overlay {
						background:transparent url(images/overlays/01.png);
						opacity:0.5;
						z-index:-1;
					}
					
					.vegas-background {
						image-rendering: optimizeQuality;
						-ms-interpolation-mode: bicubic;
						z-index:-2;
					    /* counteracts global img modification by twitter bootstrap library */
					    max-width: none !important;
					}
				</style>
				
				<div id="interested" >		
					<h1>CREATE<strong>DENTON</strong></h1>
					
					<h2>Collaborate with other creatives in Denton, TX.</h2>
					
					<?php echo do_shortcode('[gravityform id="3" name="Launch" ajax="true" title="false" description="false"]'); ?>
					
					<p>We'll send you an email when we're ready to launch &mdash; which won't be too long.</p>
					
				</div>
						
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	</div><!-- #primary -->

	<?php if( !is_user_logged_in() ): ?>
		
		<div class="modal hide" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up-label" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="sign-up-label">Sign Up</h3>
			</div>
			<div class="modal-body">
				<?php echo do_shortcode('[gravityform id="1" name="Sign Up" ajax="true" title="false" description="false"]'); ?>
			</div>
		</div>
		
	<?php endif; ?>	

<?php get_footer(); ?>
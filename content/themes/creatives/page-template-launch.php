<?php
/**
 * Template Name: Home
 */

?>
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
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

				<?php if( !is_user_logged_in() ): ?>
				<style>
					body {
						background: url('http://farm5.staticflickr.com/4109/5054085719_93044fab75_o.jpg');
					}
					#interested {
						width: 310px;
					}
					#interested form {
						overflow: hidden;
					}
					#interested label {
						display: inline-block;
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
				</style>
				
				<div id="interested" >		
					<h1>Create Denton</h1>
					<?php echo do_shortcode('[gravityform id="3" name="Launch" ajax="true" title="false" description="false"]'); ?>
					
					<p style="text-align:center;">Want to collaborate with other creative professionals in Denton, TX?</p>
					<p style="text-align:center;">We'll send you an email when we're ready to launch &mdash; which won't too long.</p>
					
				</div>
						
			<?php else: ?>				
				
				<div class="span2">

					<?php get_sidebar( 'filter' ); ?>
			
				</div><!-- .span2 -->

				<div class="span10">
					
					<div class="row-fluid">
						
						<?php if ( is_user_logged_in() && !cd_is_valid_user( $current_user->ID ) ) { ?>
							<div class="alert alert-warning">Your profile is not public because it is missing <strong><?php echo cd_user_errors( $current_user->ID  ); ?></strong>. Please <a href="#edit-profile" data-toggle="modal">edit your profile</a>.</div>
						<?php } ?>
												
						<ul id="the-creatives" class="ourHolder">
				
							<?php get_template_part( 'card' ); // Loads card.php ?>
						
						</ul>
					
					</div><!-- .row-fluid -->
			
				</div><!-- .span2 -->
							
			</div>
			
			<?php endif; ?>
						
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
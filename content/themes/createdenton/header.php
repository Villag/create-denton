<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the top of the file. It is used mostly as an opening
 * wrapper, which is closed with the footer.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Hybrid
 * @subpackage Template
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php hybrid_document_title(); ?></title>
<?php wp_head(); ?>

<?php
/* Inserts Google Analytics script if not local environment */
if ( defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV == false ) { ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35667323-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

$(document).ready(function() {
	$("body").iealert({ support: "ie9" });
});

</script>
<?php } ?>
</head>

<body <?php body_class(); ?>>
	
	<header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="navbar navbar-inverse row-fluid" role="navigation">
			<div class="navbar-inner">
				<h1 class="brand"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">Create <strong>Denton</strong></a></h1>
				<div class="skip-link assistive-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a></div>
				<div class="menu-primary-container">
					<ul id="menu-primary" class="nav">
						<li id="filter" class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter <b class="caret"></b></a>
                        	<ul class="option-set dropdown-menu" data-option-key="filter">
						        <li data-filter=".photographer">	<a href="#filter">Photographer</a></li>
						        <li data-filter=".programmer">		<a href="#filter">Programmer</a></li>
						        <li data-filter=".film-video">		<a href="#filter">Film/Video</a></li>
						        <li data-filter=".writer">			<a href="#filter">Writer</a></li>
						        <li data-filter=".web-designer">	<a href="#filter">Web Designer</a></li>
						        <li data-filter=".graphic-designer"><a href="#filter">Graphic Designer</a></li>
						        <li data-filter=".other">			<a href="#filter">Other</a></li>
						        <li data-filter="*" class="selected"><a href="#filter">Reset</a></li>
	                        </ul>
						</li>
					</ul>
					
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
 
					<ul class="nav nav-collapse collapse pull-right">

						<li class="menu-item highlight"><a href="#" data-reveal-id="feedback" data-animation="fade" data-animationSpeed="12000">Feedback</a></li>

						<li class="menu-item"><a href="#" data-reveal-id="about" data-animation="fade" data-animationSpeed="12000">About</a></li>

						<?php if( is_user_logged_in() ): ?>
					
						<li>
							<a href="#" data-reveal-id="edit-profile" data-animation="fade" data-animationSpeed="12000">Edit profile</a>
						</li>
						<li>
							<a href="<?php echo wp_logout_url( get_home_url() ); ?>" title="Logout">Logout</a>
						</li>
						
						<?php else: ?>
					
							<li>
								<a href="#" data-reveal-id="login" data-animation="fade" data-animationSpeed="12000">Login</a>
							</li>
							<li>
								<a href="#" data-reveal-id="sign-up" data-animation="fade" data-animationSpeed="12000">Sign Up</a>
							</li>
					
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav><!-- #site-navigation -->

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->
	
<div id="page" class="hfeed site container-fluid">

	<div id="main" class="wrapper">
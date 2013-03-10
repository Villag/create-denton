<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php hybrid_document_title(); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); // wp_head ?>

</head>

<body class="<?php hybrid_body_class(); ?>">

	<div id="container">

		<nav id="site-navigation" class="navbar navbar-inverse navbar-fixed-top row-fluid" role="navigation">
			
			<div class="navbar-inner">
				<h1 class="brand"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">Create <strong>Denton</strong></a></h1>
				<label>beta!</label>
				<div class="skip-link assistive-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a></div>
				<div class="menu-primary-container">
					
					<a class="btn btn-navbar" data-toggle="collapse" data-target="#menu-secondary">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					
					<ul id="menu-secondary" class="nav nav-collapse collapse pull-right">

						<li class="dropdown">

							<?php
							if( is_user_logged_in() ):
							global $current_user;
							get_currentuserinfo();
							?>

							<a href="#" class="menu-item dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo cd_get_avatar( $current_user->ID ); ?>" class="avatar pull-left" height="25" width="25" alt="<?php echo get_user_meta( $current_user->ID, 'first_name', true ); ?> <?php echo get_user_meta( $current_user->ID, 'last_name', true ); ?>">
								<?php echo $current_user->user_login; ?> <b class="caret"></b></a>

							<ul class="dropdown-menu">
								<li class="menu-item">			<a href="<?php echo home_url(); ?>/profile">Edit profile</a></li>
								<li class="menu-item">			<a href="<?php echo wp_logout_url( get_home_url() ); ?>" title="Logout">Logout</a></li>
								<li class="divider"></li>
								<li class="menu-item">			<a href="<?php echo home_url(); ?>/about">About</a></li>
								<li class="menu-item">			<a href="https://www.facebook.com/CreateDenton" target="_blank">Like us on Facebook</a></li>
							</ul>

							<?php else: ?>

							<li class="menu-item">			<a href="<?php echo home_url(); ?>/about">About</a></li>
							<li class="menu-item">			<a href="#" data-animation="fade" data-animationSpeed="12000" data-reveal-id="login">Login</a></li>
							<li class="menu-item">			<a href="#" data-animation="fade" data-animationSpeed="12000" data-reveal-id="sign-up">Sign Up</a></li>

							<?php endif; ?>

						</li>

					</ul>
					
					<ul id="menu-primary" class="nav">
						<?php if( is_front_page() ): ?>
						<li id="filter">
                        	<ul id="filters" class="option-set" data-option-key="filter">
						        <li data-filter=".graphic-designer"><a href="#filter">Graphic Designer</a></li>
						        <li data-filter=".web-designer">	<a href="#filter">Web Designer</a></li>
						        <li data-filter=".photographer">	<a href="#filter">Photographer</a></li>
						        <li data-filter=".programmer">		<a href="#filter">Programmer</a></li>
						        <li data-filter=".film-video">		<a href="#filter">Film/Video</a></li>
						        <li data-filter=".writer">			<a href="#filter">Writer</a></li>
						        <li data-filter=".other">			<a href="#filter">Other</a></li>
						        <li data-filter="*" class="selected"><a href="#filter">Reset</a></li>
	                        </ul>
						</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			
		</nav><!-- #site-navigation -->

		<div id="main">

			<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) breadcrumb_trail( array( 'container' => 'nav', 'separator' => '>', 'before' => __( 'You are here:', 'hybrid-base' ) ) ); ?>
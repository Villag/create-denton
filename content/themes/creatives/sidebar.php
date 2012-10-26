<li id="sidebar" class="item sidebar">
	
	<h1 class="brand">Create <strong>Denton</strong></h1>

	<?php if( is_user_logged_in() ): ?>

	<div class="btn-group">
		<a class="btn" data-toggle="modal" role="button" href="#edit-profile">Edit profile</a>
		<a class="btn" href="<?php echo wp_logout_url( get_home_url() ); ?>" title="Logout">Logout</a>
	</div>
	
	<?php global $current_user; if ( !cd_is_valid_user( $current_user->ID ) ) { ?>
	<div class="alert alert-warning">Your profile is not public because it's missing <strong><?php echo cd_user_errors( $current_user->ID  ); ?></strong>. Please <a href="#edit-profile" data-toggle="modal">edit your profile</a>.</div>
	<?php } ?>
	
	<?php else: ?>

		<div class="btn-group">
			<a class="btn" data-toggle="modal" role="button" href="#login">Login</a>
			<a class="btn btn-primary" data-toggle="modal" role="button" href="#login">Sign Up</a>
		</div>

	<?php endif; ?>
	
	<h3 class="menu-toggle"><?php _e( 'Filter by type', 'create_denton' ); ?></h3>
	<p>
		<a class="btn btn-inverse menu-toggle" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
	</p>

	<div id="filters" class="nav-collapse animatedgradientbackground">
		<ul class="option-set" data-option-key="filter">
			<li data-filter=".illustrator">		<a href="#filter">Illustrator</a></li>
	        <li data-filter=".photographer">	<a href="#filter">Photographer</a></li>
	        <li data-filter=".programmer">		<a href="#filter">Programmer</a></li>
	        <li data-filter=".film-video">		<a href="#filter">Film/Video</a></li>
	        <li data-filter=".writer">			<a href="#filter">Writer</a></li>
	        <li data-filter=".web-designer">	<a href="#filter">Web Designer</a></li>
	        <li data-filter=".graphic-designer"><a href="#filter">Graphic Designer</a></li>
	        <li data-filter=".fine-art">		<a href="#filter">Fine Art</a></li>
	        <li data-filter=".other">			<a href="#filter">Other</a></li>
	        <li data-filter="*" class="selected"><a href="#filter">Reset</a></li>
		</ul><!-- #filters.nav.nav-list -->
	</div><!-- .nav-collapse -->
</li><!-- .item.filters -->
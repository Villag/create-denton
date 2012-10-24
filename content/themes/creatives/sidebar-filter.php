<li id="filters" class="item filters">
	
	<h1>Create Denton</h1>

	<?php if( is_user_logged_in() ): ?>

	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
			<ul class="nav">
				<li><a data-toggle="modal" role="button" href="#edit-profile">Edit profile</a></li>
				<li><?php wp_loginout( get_home_url() ); ?></li>
			</ul>
		</div>
	</div>
	
	<?php if ( !cd_is_valid_user( $current_user->ID ) ) { ?>
	<div class="alert alert-warning">Your profile is not public because it's missing <strong><?php echo cd_user_errors( $current_user->ID  ); ?></strong>. Please <a href="#edit-profile" data-toggle="modal">edit your profile</a>.</div>
	<?php } ?>
	
	<?php else: ?>
	<style>
        .link_wrapper a {
        	float: right;
            position: relative;
            text-transform: uppercase;
        } 
        .link_wrapper a.register {
            display: block;
            background-image: url(//cdn.mxpnl.com/cache/510793bb3a2c02e2e837f141c2a7319b/images/static/login_signup.png);
            background-position: -90px -3px;
            width: 90px;
            height: 32px;
            top: 20px;
        }
        .link_wrapper a.login {
            display: block;
            background-image: url(//cdn.mxpnl.com/cache/510793bb3a2c02e2e837f141c2a7319b/images/static/login_signup.png);
            background-position: 0 -3px;
            width: 90px;
            height: 32px;
            top: 20px;
        }
        .link_wrapper a.register:hover {
            background-position: -90px -36px;
        }
        .link_wrapper a.login:hover {
            background-position: 0 -36px;
        }
	</style>		
	<div class="link_wrapper">
		<a class="register" data-toggle="modal" role="button" href="#login"></a>
		<a class="login" data-toggle="modal" role="button" href="#login"></a>
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

	<div class="nav-collapse">
		<ul class="option-set clearfix corner-stamp" data-option-key="filter">
			<li class="illustrator">		<span class="legend"></span><a data-filter=".illustrator" href="#filter">Illustrator</a></li>
	        <li class="photographer">		<span class="legend"></span><a data-filter=".photographer" href="#filter">Photographer</a></li>
	        <li class="programmer">			<span class="legend"></span><a data-filter=".programmer" href="#filter">Programmer</a></li>
	        <li class="film-video">			<span class="legend"></span><a data-filter=".film-video" href="#filter">Film/Video</a></li>
	        <li class="writer">				<span class="legend"></span><a data-filter=".writer" href="#filter">Writer</a></li>
	        <li class="web-designer">		<span class="legend"></span><a data-filter=".web-designer" href="#filter">Web Designer</a></li>
	        <li class="graphic-designer">	<span class="legend"></span><a data-filter=".graphic-designer" href="#filter">Graphic Design</a></li>
	        <li class="fine-art">			<span class="legend"></span><a data-filter=".fine-arts" href="#filter">Fine Art</a></li>
	        <li class="other">				<span class="legend"></span><a data-filter=".other" href="#filter">Other</a></li>
	        <li class="reset">				<a href="#filter" data-filter="*" class="selected">Reset</a></li>
		</ul><!-- #filters.nav.nav-list -->
	</div><!-- .nav-collapse -->
</li><!-- .item.filters -->
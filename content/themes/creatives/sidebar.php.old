<li id="sidebar" class="item sidebar">
	
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
	
</li><!-- .item.filters -->
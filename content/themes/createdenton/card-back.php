<?php
// Get all users
$users = get_users();
if( $users ) {
	echo '<ul id="vcards">';
	// Loop through each user
	foreach ( $users as $user ) {
		global $wp_query;
		$user_info = get_userdata( $user->ID ); // TODO: Explain what this gets
		$all_meta_for_user = get_user_meta( $user->ID ); // TODO: Explain what this gets
		$curauth = $wp_query->get_queried_object(); // TODO: Explain what this gets
		
		$user_type = strtolower( get_user_meta( $user->ID, 'user_primary_job', true ) ); // Converts the Primary Job output to lower case
		$user_type = preg_replace("![^a-z0-9]+!i", "-", $user_type ); // Converts spaces in the primary job to hyphens

		$username = strtolower( $user_info->user_login );
		$username = preg_replace("![^a-z0-9]+!i", "-", $username );

		$user_primary_job		= get_user_meta( $user->ID, 'user_primary_job', true );
		$user_first_name		= get_user_meta( $user->ID, 'first_name', true );
		$user_last_name			= get_user_meta( $user->ID, 'last_name', true );
		$user_email				= $user->user_email;
		$user_website			= get_user_meta( $user->ID, 'user_website', true );
		$user_description		= $user_info->user_description;
		$user_phone				= get_user_meta( $user->ID, 'user_phone', true );
		$user_zip_code			= get_user_meta( $user->ID, 'user_zip', true );
		$user_twitter			= get_user_meta( $user->ID, 'user_twitter', true );
		$user_linkedin_url		= get_user_meta( $user->ID, 'user_linkedin', true );
		$user_skills			= get_user_meta( $user->ID, 'user_skills', false );
		
		// If the user isn't valid, skip them
		if ( !cd_is_valid_user( $user->ID ) ) continue; ?>

		<li>

			<div id="<?php echo $user->ID; ?>" class="reveal-modal person <?php echo $user_type; ?>" role="dialog" aria-labelledby="modal-person-label" aria-hidden="true" data-type="<?php echo $user_type; ?>">

				<figure id="vcard-lastfirst-<?php echo $user->ID ?>" itemscope="itemscope" itemtype="http://www.data-vocabulary.org/Person/">

					<figcaption>

						<div class="modal-header">
							<a class="close-reveal-modal">&#215;</a>
							<?php if( $user_first_name || $user_last_name || $user_primary_job ) { ?>
							<header class="n" title="Name">
								<?php if( $user_first_name || $user_last_name ) { ?>
								<h3 class="fn" itemprop="name">
									<?php if( $user_first_name ) { ?><span class="given-name"><?php echo $user_first_name; ?></span><?php } ?>
									<?php if( $user_last_name ) { ?><span class="family-name"><?php echo $user_last_name; ?></span><?php } ?>
								</h3>
								<?php } ?>
								<?php if( $user_primary_job ) { ?><div class="primary-job"><?php echo $user_primary_job; ?></div><?php } ?>
							</header><!-- .n -->
							<?php } ?>
						</div><!-- .modal-header -->

						<div class="modal-body">
							
							<img src="<?php echo cd_get_avatar( $user->ID ); ?>" class="avatar thumbnail pull-right" height="150" width="150" alt="<?php echo get_user_meta( $user->ID, 'first_name', true ); ?> <?php echo get_user_meta( $user->ID, 'last_name', true ); ?>">

							<?php if( $user_website || $user_twitter || $user_email || $user_phone ) { ?>
							<section class="note">
								<header>
										<h4>Contact</h4>
								</header>
								<ul class="border-left">
									<?php if( $user_website ) { ?><li class="website"><a href="<?php echo $user_website; ?>" target="_blank" class="url" itemprop="url" rel="me self external"><?php echo $user_website; ?></a></li><?php } ?>
									<?php if( $user_twitter ) { ?><li class="twitter"><a href="http://twitter.com/<?php echo $user_twitter; ?>" target="_blank"><i class="icon-twitter"></i> <?php echo $user_twitter; ?></a></li><?php } ?>
									<?php if( $user_phone && is_user_logged_in() ) { ?>
										<li class="tel"><abbr class="value" itemprop="tel" title="+1<?php echo $user_phone; ?>"><?php echo $user_phone; ?></abbr></li>
									<?php } elseif( !$user_phone && !is_user_logged_in() ) { ?>
										<li><small><a href="#" data-reveal-id="login" data-animation="fade" data-animationSpeed="12000">Login to get phone number</a></small></li>
									<?php } ?>
									<?php if( $user_email && is_user_logged_in() ) { ?>
										<li class="email"><a href="#" data-reveal-id="contact-<?php echo $user->ID; ?>" data-animation="fade" data-animationSpeed="12000"><i class="icon-envelope"></i> Email</a></li>
									<?php } elseif( !$user_email && !is_user_logged_in() ) { ?>
										<li><small><a href="#" data-reveal-id="login" data-animation="fade" data-animationSpeed="12000">Login to email this user</a></small></li>
									<?php } ?>
								</ul>
							</section>
							<?php } ?>

							<section title="Biography">
								<?php if( $user_description ){ ?>
								<header>
									<h4>Biography</h4>
								</header>
								<p><?php echo $user_description; ?></p>
								<?php } ?>
								<?php
								if( $user_skills ):
									$user_skills = unserialize( $user_skills[0] );
									echo '<section><header><h4>Skills</h4></section>';
									echo '<ul class="border-left">';
									foreach( $user_skills as $skill ) {
										echo '<li>'. $skill .'</li>';
									}
									echo '</ul></section>';
								endif;
								?>
							</section>

						</div><!-- modal-body -->

					</figcaption><!-- .figcaption -->

				</figure>

			</div><!-- .vcard -->
			
			<div id="contact-<?php echo $user->ID; ?>" class="reveal-modal <?php echo $user_type; ?>">
				<div class="modal-header">
					<img src="<?php echo cd_get_avatar( $user->ID ); ?>" class="avatar pull-left" height="30" width="30" alt="<?php echo get_user_meta( $user->ID, 'first_name', true ); ?> <?php echo get_user_meta( $user->ID, 'last_name', true ); ?>">
					<h3>Email <?php echo $user_first_name; ?></h3>
				</div>
				<div class="modal-body">
					<?php gravity_form( 'Contact User', false, true, false, array('to_email' => antispambot( $user_email ) ), true ); ?>
				</div>
			</div>

		</li>

	<?php
	}
	echo '</ul>';
} ?>
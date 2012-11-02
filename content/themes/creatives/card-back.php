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
		
		$user_type = strtolower( get_user_meta( $user->ID, 'Primary Job', true ) ); // Converts the Primary Job output to lower case
		$user_type = preg_replace("![^a-z0-9]+!i", "-", $user_type ); // Converts spaces in the primary job to hyphens

		$username = strtolower( $user_info->user_login );
		$username = preg_replace("![^a-z0-9]+!i", "-", $username );

		$user_primary_job		= get_user_meta( $user->ID, 'Primary Job', true );
		$user_first_name		= get_user_meta( $user->ID, 'first_name', true );
		$user_last_name			= get_user_meta( $user->ID, 'last_name', true );
		$user_last_name			= get_user_meta( $user->ID, 'last_name', true );
		$user_email				= $user->user_email;
		$user_website			= get_the_author_meta( 'user_url', $user->ID );
		$user_description		= $user_info->user_description;
		$user_phone				= get_user_meta( $user->ID, 'Phone', true );
		$user_zip_code			= get_user_meta( $user->ID, 'Zip Code', true );
		$user_twitter			= get_user_meta( $user->ID, 'Twitter Username', true );
		$user_linkedin_url		= get_user_meta( $user->ID, 'LinkedIn URL', true );
		$user_skills			= get_user_meta( $user->ID, 'Skills', false );

		echo antispambot( $user->user_email );
		// If the user isn't valid, skip them
		if ( !cd_is_valid_user( $user->ID ) ) continue; ?>

		<li>

			<div id="<?php echo $user->ID; ?>" class="reveal-modal <?php echo $user_type; ?>" role="dialog" aria-labelledby="modal-person-label" aria-hidden="true" data-type="<?php echo $user_type; ?>">

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
							
							<?php cd_gravatar_timthumb( $user->user_email, 150, 150, 'avatar thumbnail pull-right' ); ?>

							<?php if( $user_website || $user_twitter || $user_email || $user_phone ) { ?>
							<section class="note">
								<header>Contact</header>
								<ul>
									<?php if( $user_website ) { ?><li class="website"><a href="<?php echo $user_website; ?>" class="url" itemprop="url" rel="me self external"><?php echo $user_website; ?></a></li><?php } ?>
									<?php if( $user_twitter ) { ?><li class="twitter"><a href="http://twitter.com/<?php echo $user_twitter; ?>">@<?php echo $user_twitter; ?></a></li><?php } ?>
									<?php if( $user_phone && is_user_logged_in() ) { ?>
										<li class="tel"><abbr class="value" itemprop="tel" title="+1<?php echo $user_phone; ?>"><?php echo $user_phone; ?></abbr></li>
									<?php } else { ?>
										<li><small><a href="#" data-reveal-id="login" data-animation="fade" data-animationSpeed="12000">Login to get phone number</a></small></li>
									<?php } ?>
									<?php if( $user_email && is_user_logged_in() ) { ?>
										<li class="email"><a href="#" data-reveal-id="contact-<?php echo $user->ID; ?>" data-animation="fade" data-animationSpeed="12000"><i class="icon-envelope"></i> Email</a></li>
									<?php } else { ?>
										<li><small><a href="#" data-reveal-id="login" data-animation="fade" data-animationSpeed="12000">Login to email this user</a></small></li>
									<?php } ?>
								</ul>
							</section>
							<?php } ?>

							<section title="Biography">
								<?php if( $user_description ){ ?>
								<header>
									Biography
								</header>
								<p><?php echo $user_description; ?></p>
								<?php } ?>
								<?php
								if( $user_skills ):
									$user_skills = unserialize( $user_skills[0] );
									echo '<section><header>Skills</skills>';
									echo '<ul>';
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
					<?php cd_gravatar_timthumb( $user->user_email, 30, 30, 'avatar pull-left' ); ?>
					<h3>Email <?php echo $user_first_name; ?></h3>
				</div>
				<div class="modal-body">
					<?php gravity_form( 4, false, true, false, array('to_email' => antispambot( $user_email ) ), true ); ?>
				</div>
			</div>

		</li>

	<?php
	}
	echo '</ul>';
} ?>
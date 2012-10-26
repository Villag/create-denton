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
			
		// If the user isn't valid, skip them
		if ( !cd_is_valid_user( $user->ID ) ) continue; ?>
		
		<li>
			<div id="<?php echo $username; ?>" class="vcard hide modal fade <?php echo $user_type; ?>" role="dialog" aria-labelledby="modal-person-label" aria-hidden="true" data-type="<?php echo $user_type; ?>">
					
				<figure id="vcard-lastfirst-<?php echo $user->ID ?>" itemscope="itemscope" itemtype="http://www.data-vocabulary.org/Person/">
			
					<figcaption>
			
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<header class="n" title="Name">
								<h3>
									<span class="fn" itemprop="name">
										<span class="given-name"><?php echo get_user_meta( $user->ID, 'first_name', true ); ?></span>
										<span class="family-name"><?php echo get_user_meta( $user->ID, 'last_name', true ); ?></span>
									</span><!-- .fn -->
								</h3>
							</header><!-- .n -->
						</div><!-- .modal-header -->
						
						<div class="modal-body">
					
							<section class="profile">
								
								<p><?php echo get_user_meta( $user->ID, 'Primary Job', true ); ?></p>
								<address class="adr" itemprop="address" title="Location" itemscope="itemscope" itemtype="http://data-vocabulary.org/Address/">
									<abbr class="postal-code" itemprop="postal-code" title="<?php echo get_user_meta( $user->ID, 'Zip Code', true ); ?>"><?php echo get_user_meta( $user->ID, 'Zip Code', true ); ?></abbr>
								</address>
			
								<a href="mailto:<?php echo $user->user_email ?>" class="email"><?php echo $user->user_email ?></a>
								<ul itemscope="itemscope" itemtype="http://www.data-vocabulary.org/Organization/">
									<li class="tel"><abbr class="type" title="work">Phone:</abbr> <abbr class="value" itemprop="tel" title="+1<?php echo get_user_meta( $user->ID, 'Phone', true ); ?>"><?php echo get_user_meta( $user->ID, 'Phone', true ); ?></abbr></li>
								</ul>
							</section><!-- .profile -->
			
							<section class="note">
								<ul>
									<li><a href="<?php the_author_meta( 'user_url', $user->ID ); ?>" class="url" itemprop="url" rel="me self external"><?php the_author_meta( 'user_url', $user->ID ); ?></a></li>
								</ul>
							</section>
							
							<section title="Biography">
								<header>
									Biography
								</header>
								<p><?php echo $user_info->user_description; ?></p>
								<section>
									<?php
									$skills = get_user_meta( $user->ID, 'Skills', false );
									if( $skills ):
										echo '<header>Skills</skills>';
										echo '<ul>';
										foreach( $skills as $skill ) {
											echo '<li><a href="#" rel="tag">'. $skill .'</a><li>';
										}
										echo '</ul>';
									endif;
									?>
								</section>
							</section>
						
						</div><!-- modal-body -->
						
					</figcaption><!-- .figcaption -->
					
				</figure>
				
			</div><!-- .vcard -->
					
		</li>
	
	<?php
	}
	echo '</ul>';
} ?>
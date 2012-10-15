<?php
$users = get_users();
foreach ( $users as $user ) {
	global $wp_query;
	$user_info = get_userdata( $user->ID );
	$all_meta_for_user = get_user_meta( $user->ID );
	$curauth = $wp_query->get_queried_object();

	?>
	
	<?php if ( !cd_is_valid_user( $user->ID ) ) continue; ?>

	<div class="thumb scroll" id="card-<?php echo $user->ID ?>" data-id="<?php echo get_user_meta( $user->ID, 'Primary Job', true ); ?>">
		<div class="thumb-wrapper">
			<?php echo get_avatar( $user->ID, '300', 'http://www.adas-lv.com/wp-content/uploads/2012/07/default_avatar.png', $user->display_name ); ?>
			<div class="thumb-detail">
				
				<div class="vcard card back">
				
					<figure id="vcard-lastfirst-<?php echo $user->ID ?>"
					 itemscope="itemscope" itemtype="http://www.data-vocabulary.org/Person/"
	
						<figcaption>
							<!-- Profile -->
							<section class="profile">
								<!-- Name -->
								<header class="n" title="Name">
									<span class="fn" itemprop="name">
										<span class="given-name"><?php echo get_user_meta( $user->ID, 'first_name', true ); ?></span>
										<span class="family-name"><?php echo get_user_meta( $user->ID, 'last_name', true ); ?></span>
									</span> <!--/ .fn -->
								</header> <!--/ .n -->
								<p><?php echo get_user_meta( $user->ID, 'Primary Job', true ); ?></p>
								<!-- Location -->
								<address class="adr" itemprop="address" title="Location"
								 itemscope="itemscope" itemtype="http://data-vocabulary.org/Address/">
									<!-- Zip --><abbr class="postal-code" itemprop="postal-code" title="<?php echo get_user_meta( $user->ID, 'Zip Code', true ); ?>"><?php echo get_user_meta( $user->ID, 'Zip Code', true ); ?></abbr>
									<!-- Lat/Lon (Metadata) -->
								</address> <!--/ .adr -->
								<!-- Contact -->
								<a href="mailto:<?php echo $user->user_email ?>" class="email"><?php echo $user->user_email ?></a>
								<ul itemscope="itemscope" itemtype="http://www.data-vocabulary.org/Organization/">
									<li class="tel"><abbr class="type" title="work">Phone:</abbr> <abbr class="value" itemprop="tel" title="+1<?php echo get_user_meta( $user->ID, 'Phone', true ); ?>"><?php echo get_user_meta( $user->ID, 'Phone', true ); ?></abbr></li>
								</ul>
							</section> <!--/ .profile -->
							<!-- Links -->
							<section class="note">
								<ul>
									<li><a href="<?php the_author_meta( 'user_url', $user->ID ); ?>" class="url" itemprop="url" rel="me self external"><?php the_author_meta( 'user_url', $user->ID ); ?></a></li>
								</ul>
							</section>
							<!-- Biography
							<section title="Biography">
								<header>
									Biography
								</header>
								<p><?php echo $user_info->user_description; ?></p>
								<section>
									<?php
									$skills = get_user_meta( $user->ID, 'Skills' );
									if( $skills ):
										echo '<header>Skills</skills>';
										echo '<ul>';
										foreach( $skills as $skill ) {
											echo '<li><a href="#" rel="tag">'. $skill[0] .'</a><li>';
										}
										echo '</ul>';
									endif;
									?>
								</section>
							</section> <!--/ .note -->
						</figcaption> <!--/ .figcaption -->
						
					</figure>
					
				</div>
	
			</div>
		</div>
	</div>	

<?php } ?>
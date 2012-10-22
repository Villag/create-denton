<?php
/**
 * Template Name: Home
 */

get_header(); ?>

	<div id="primary" class="site-content">
		
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
			<div class="row-fluid">
									
				<ul id="the-creatives" class="ourHolder">
					
					<?php get_sidebar( 'filter' ); ?>

					<li class="item intro">
							
						<div class="card">
												
						<?php if( is_user_logged_in() ): ?>

							<div class="navbar navbar-inverse">
								<div class="navbar-inner">
									<ul class="nav">
										<li><a data-toggle="modal" role="button" href="#modal-edit-profile">Edit profile</a></li>
										<li><?php wp_loginout(); ?></li>
									</ul>
								</div>
							</div>
							
							<?php if ( !cd_is_valid_user( $current_user->ID ) ) { ?>
							<div class="alert alert-warning">Your profile is not public because it's missing <strong><?php echo cd_user_errors( $current_user->ID  ); ?></strong>. Please <a href="#modal-edit-profile" data-toggle="modal">edit your profile</a>.</div>
							<?php } ?>

						<?php else: ?>
							
							<p><a data-toggle="modal" role="button" href="#modal-login">Login</a></p>
							
							<?php echo do_shortcode('[gravityform id=1 title=false description=false]'); ?>
					
						<?php endif; ?>
						
						</div><!-- .card -->
						
					</li><!-- .item.intro -->
		
					<?php get_template_part( 'card-front' ); // Loads card-front.php ?>
					
				</ul><!-- #the-creatives -->
							
			</div><!-- .row-fluid -->
						
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	</div><!-- #primary -->
	
<?php get_footer(); ?>
<?php
/**
 * Template Name: Home
 */

get_header(); ?>

	<div id="primary" class="site-content">
		
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
			<div class="row-fluid">			
							
				<?php global $current_user; if ( is_user_logged_in() && !cd_is_valid_user( $current_user->ID ) ) { ?>
					<div class="alert alert-warning">Your profile is not public because it is missing <strong><?php echo cd_user_errors( $current_user->ID  ); ?></strong>. Please <a href="#edit-profile" data-toggle="modal">edit your profile</a>.</div>
				<?php } ?>
										
				<ul id="the-creatives" class="ourHolder">
					
					<?php get_sidebar( 'filter' ); ?>
					
					<?php if( is_user_logged_in() ): ?>
						
					<li class="item intro">
							
						<div class="card">
			            	<p><a href="#edit-profile" data-toggle="modal">Edit profile</a></p>
			            	<p><?php wp_loginout(); ?></p>
						</div>
						
					</li>
						
					<?php else: ?>
						
					<li class="item intro">
						
						<div class="card">
							
							<a class="card" href="#login" role="button" data-toggle="modal">Login</a>
							
							<?php echo do_shortcode('[gravityform id=1 title=false description=false]'); ?>
												
						</div>
						<div id="login" class="hide modal fade in" role="dialog" aria-hidden="true">

							<?php wp_login_form(); ?>
							
						</div>
					
					</li>
					
					<?php endif; ?>
		
					<?php get_template_part( 'card' ); // Loads card.php ?>
					
				</ul>
							
			</div>
						
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	</div><!-- #primary -->
	
<?php get_footer(); ?>
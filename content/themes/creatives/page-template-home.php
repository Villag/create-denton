<?php
/**
 * Template Name: Home
 */

get_header(); ?>

	<div id="primary" class="site-content">
		
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
			<div class="row-fluid">

				<ul id="the-creatives" class="filterable-grid">
					
					<?php get_sidebar( 'filter' ); ?>
												
					<?php if( !is_user_logged_in() ): ?>

					<li class="item intro">
							
						<div class="card">
													
							<p><a data-toggle="modal" role="button" href="#modal-login">Login</a></p>
							
							<?php echo do_shortcode('[gravityform id=1 title=false description=false]'); ?>
				
						</div><!-- .card -->
						
					</li><!-- .item.intro -->
					
					<?php endif; ?>
		
					<?php get_template_part( 'card-front' ); // Loads card-front.php ?>
					
				</ul><!-- #the-creatives -->
							
			</div><!-- .row-fluid -->
						
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	</div><!-- #primary -->
	
<?php get_footer(); ?>
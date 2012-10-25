<?php
/**
 * Template Name: Home
 */

get_header(); ?>

	<div id="primary" class="site-content">
		
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
			<div class="row-fluid">

				<ul id="the-creatives">
					
					<?php get_sidebar(); // Loads sidebar.php ?>
					
					<?php get_template_part( 'card-front' ); // Loads card-front.php ?>
					
				</ul><!-- #the-creatives -->
							
			</div><!-- .row-fluid -->
						
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	</div><!-- #primary -->
	
<?php get_footer(); ?>
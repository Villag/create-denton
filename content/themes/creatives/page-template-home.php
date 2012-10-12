<?php
/**
 * Template Name: Home
 */

get_header(); ?>

	<div id="primary" class="site-content">
		
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
			<div class="row-fluid">
				
				<div class="span2">

					<?php get_sidebar(); ?>

<ul id="source">
	<li data-id="Web Designer">Web Designer</li>
	<li data-id="android">Android</li>
	<li data-id="winmo">Windows Mobile</li>
</ul>
			
				</div><!-- .span2 -->

				<div class="span10">
					
					<div class="row-fluid">

						<?php get_template_part( 'card-front' ); // Loads card-front.php ?>
					
					</div><!-- .row-fluid -->
			
				</div><!-- .span2 -->
							
			</div>
						
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	</div><!-- #primary -->

	<?php if( !is_user_logged_in() ): ?>
		
		<div class="modal hide" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up-label" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="sign-up-label">Sign Up</h3>
			</div>
			<div class="modal-body">
				<?php echo do_shortcode('[gravityform id="1" name="Sign Up" ajax="true" title="false" description="false"]'); ?>
			</div>
		</div>
		
	<?php endif; ?>	
	
<?php get_footer(); ?>
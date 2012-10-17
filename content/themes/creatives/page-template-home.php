<?php
/**
 * Template Name: Home
 */

get_header(); ?>

	<div id="primary" class="site-content">
		
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
			<div class="row-fluid">			
				
				<div class="span3">

					<?php get_sidebar( 'filter' ); ?>
			
				</div><!-- .span2 -->

				<div class="span9">
					
					<div class="row-fluid">
						
						<?php global $current_user; if ( is_user_logged_in() && !cd_is_valid_user( $current_user->ID ) ) { ?>
							<div class="alert alert-warning">Your profile is not public because it is missing <strong><?php echo cd_user_errors( $current_user->ID  ); ?></strong>. Please <a href="#edit-profile" data-toggle="modal">edit your profile</a>.</div>
						<?php } ?>
												
						<ul id="the-creatives" class="ourHolder">
				
							<?php get_template_part( 'card' ); // Loads card.php ?>
						
						</ul>
					
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
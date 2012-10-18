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
							
							<?php if( is_user_logged_in() ): ?>
								
								<div class="card">

									<div class="card-wrapper">
										
										<div class="card-front">
							            	<p><a href="#edit-profile" data-toggle="modal">Edit profile</a></p>
							            	<p><?php wp_loginout(); ?></p>
										</div>
										
									</div>
																		
								</div>
								
							<?php else: ?>
								
								<div class="card">
									
									<div class="card-wrapper">
										
										<div class="card-front">
											
											<form class="form-inline" method="post" enctype="multipart/form-data" target="gform_ajax_frame_1" id="gform_1" action="/#gf_1">
												
												<input tabindex="1" type="email" name="input_2" id="input_1_2"  value="" class="span12"  placeholder="Email">
												<input tabindex="2" type="password" name="input_5" id="input_1_5" value="" class="span6" placeholder="Password">
												<input tabindex="3" type="password" name="input_5_2" id="input_1_5_2" value="" class="span6" placeholder="Confirm Password">
												<button tabindex="4" type="submit" class="btn btn-primary">Sign Up</button>
				
												<input type="hidden" name="gform_ajax" value="form_id=1&amp;title=&amp;description=">
												<input type="hidden" class="gform_hidden" name="is_submit_1" value="1">
												<input type="hidden" class="gform_hidden" name="gform_submit" value="1">
												<input type="hidden" class="gform_hidden" name="gform_unique_id" value="507f445c099c2">
												<input type="hidden" class="gform_hidden" name="state_1" value="YToyOntpOjA7czo2OiJhOjA6e30iO2k6MTtzOjMyOiJlYWI4NjIyNjk1ZjQyYzg2OWM2MzYyMTQ4NDIyYjViMCI7fQ==">
												<input type="hidden" class="gform_hidden" name="gform_target_page_number_1" id="gform_target_page_number_1" value="0">
												<input type="hidden" class="gform_hidden" name="gform_source_page_number_1" id="gform_source_page_number_1" value="1">
												<input type="hidden" name="gform_field_values" value="">
				
											</form>			
																
										</div>
										
										<div class="card-back">

											<form action="/wp/wp-login.php" method="post" class="form-horizontal">
											
												<input class="input-medium" value="" tabindex="10" id="user_login" name="log" type="text" placeholder="email">
												<input class="input-medium" value="" tabindex="20" id="user_pass" name="pwd" type="password" placeholder="password">
												<label class="checkbox"> <input type="checkbox" tabindex="90"> Remember me </label>
											
												<button type="button" class="btn" data-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-primary">Login</button>
											
											</form>

										</div>
										
									</div>
								
								</div>
							
							<?php endif; ?>
				
							<?php get_template_part( 'card' ); // Loads card.php ?>
						
						</ul>
					
					</div><!-- .row-fluid -->
			
				</div><!-- .span2 -->
							
			</div>
						
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	</div><!-- #primary -->
	
<?php get_footer(); ?>
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
<?php
add_action('pre_user_query','offset_authors');

$authors_per_page = 1;
$current_page = absint(get_query_var('page'));

function offset_authors( $query ) {

    global $current_page, $authors_per_page;

    $offset = empty($current_page) ? 0 : ($current_page - 1) * $authors_per_page;    
    $query->query_limit = "LIMIT {$offset},{$authors_per_page}";
}

wp_list_authors();
echo paginate_links( );
?>
					<?php get_template_part( 'card-front' ); // Loads card-front.php ?>
					
				</ul><!-- #the-creatives -->
							
			</div><!-- .row-fluid -->
						
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	</div><!-- #primary -->
	
<?php get_footer(); ?>
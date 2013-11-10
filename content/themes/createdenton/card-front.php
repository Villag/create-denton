<?php

// Get Events
if( function_exists('tribe_get_events') ) {
	global $post;
	$events = tribe_get_events(array(
		'eventDisplay'=>'all',
		'posts_per_page'=>-1
	));
}

// Get Users
$count_args  = array(
    'fields'    => 'all_with_meta',
    'number'    => 999999
);
$user_count_query = new WP_User_Query($count_args);
$user_count = array();
$user_count = $user_count_query->get_results();
$valid_users = 0;
foreach ($user_count as $user) {

	if ( !cd_is_valid_user( $user->ID ) ) continue;

	$valid_users += 1;
}

// Count the number of users found in the query
$total_users = $valid_users ? count($valid_users) : 1;

// Grab the current page number and set to 1 if no page number is set
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// How many users to show per page
$users_per_page = 999999;

// Calculate the total number of pages.
$total_pages = 1;
$offset = $users_per_page * ($page - 1);
$total_pages = ceil($valid_users / $users_per_page);

// Main user query
$args  = array(
	'orderby'	=> 'user_registered',
	'order'		=> 'DESC',
    'fields'	=> 'all_with_meta',
    'number'	=> $users_per_page,
    'offset'	=> $offset // skip the number of users that we have per page
);

// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);

// Get the results
$users = $wp_user_query->get_results();

// Combine events and users, if there are events
if( function_exists('tribe_get_events') ) {
	$cards = array_merge( $events, $users );
} else {
	$cards = $users;
}

// Randomize cards
$cards = (array)$cards;
shuffle( $cards );

// CDisplay cards if we have any
if (!empty($cards)) {
	global $current_user;

    echo '<ul id="the-creatives">';
    // loop trough each author
    foreach ($cards as $card) {

		$object_type = get_class($card);

		if( $object_type == 'WP_Post' ):

			setup_postdata($card);
			?>

			<div class="item hcard event">
				<a class="card" href="#event-<?php echo $card->post_name; ?>" data-toggle="modal" >

					<?php echo get_the_image( array( 'image_scan' => true) ); ?>

					<header class="brief">
						<span class="event-title">
							<?php echo $card->post_title; ?>
						</span><!-- .event-title -->
						<div class="date"><?php echo tribe_get_start_date( $card->ID, true, 'M j, Y' ); ?></div>
					</header><!-- .brief -->

				</a><!-- .card -->
			</div>

			<div id="event-<?php echo $card->post_name; ?>" class="reveal-modal" role="dialog" aria-labelledby="modal-event-label" aria-hidden="true" data-type="event">

				<div class="modal-header">
					<a class="close-reveal-modal">&#215;</a>
					<header class="n" title="Name">
						<h3 class="fn" itemprop="name">
							<?php echo $card->post_title; ?>
						</h3>
						<div class="date"><?php echo tribe_get_start_date( $card->ID, true, 'M j, Y' ); ?> - <?php echo tribe_get_end_date( $card->ID, true, 'M j, Y' ); ?></div>
					</header><!-- .n -->
				</div><!-- .modal-header -->

				<div class="modal-body">

					<?php the_content(); ?>

				</div>

			</div><!-- .vcard -->
			<?php

		elseif( $object_type == 'WP_User' ):

	    	if ( !cd_is_valid_user( $card->ID ) ) continue;
	        $author_info = get_userdata($card->ID);
			$user_type = strtolower( get_user_meta( $author_info->ID, 'user_primary_job', true ) ); // Converts the Primary Job output to lower case
			$user_type = preg_replace("![^a-z0-9]+!i", "-", $user_type ); // Converts spaces in the primary job to hyphens

			?>

			<li class="item vcard person <?php echo $user_type; if( $current_user->ID == $author_info->ID ) echo ' current-user'; ?>">
				<a class="card" href="#person-<?php echo $card->ID ?>" data-toggle="modal" >

					<?php echo get_avatar( $author_info->ID, 150 ); ?>

					<header class="n brief" title="Name">
						<span class="fn" itemprop="name">
							<span class="given-name"><?php echo $author_info->first_name; ?></span>
							<span class="family-name"><?php echo $author_info->last_name; ?></span>
						</span> <!--/ .fn -->
						<div class="primary-job"><?php echo $author_info->user_primary_job; ?></div>
					</header> <!--/ .n -->

				</a><!-- .card -->

			</li><!-- .card -->

		<?php

		endif;

	}
	echo '</ul>';
} else {
	echo 'No users found';
}

// grab the current query parameters
$query_string = $_SERVER['QUERY_STRING'];

// The $base variable stores the complete URL to our page, including the current page arg
$base = get_permalink( get_the_ID() ) . '?' . remove_query_arg('page', $query_string) . '%_%';
echo '<div id="page_nav">';
echo paginate_links( array(
    'base' => $base, // the base URL, including query arg
    'format' => 'page=%#%', // this defines the query parameter that will be used, in this case "p"
	'prev_text' => __('&laquo; Previous'), // text for previous page
	'next_text' => __('Next &raquo;'), // text for next page
	'total' => $total_pages, // the total number of pages we have
	'current' => $page
));
echo '</div>';
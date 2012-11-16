<?php


	/*
	 * We start by doing a query to retrieve all users
	 * We need a total user count so that we can calculate how many pages there are
	 */
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
	
	// count the number of users found in the query
	$total_users = $valid_users ? count($valid_users) : 1;
	
	// grab the current page number and set to 1 if no page number is set
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	
	// how many users to show per page
	$users_per_page = 40;
	
	// calculate the total number of pages.
	$total_pages = 1;
	$offset = $users_per_page * ($page - 1);
	$total_pages = ceil($valid_users / $users_per_page);
	
	// main user query
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
	$contributors = $wp_user_query->get_results();
	
	// check to see if we have users
	if (!empty($contributors)) {
		global $current_user;
		
	    echo '<ul id="the-creatives">';
	    // loop trough each author
	    foreach ($contributors as $author) {
	    	if ( !cd_is_valid_user( $author->ID ) ) continue;
	        $author_info = get_userdata($author->ID);
			$user_type = strtolower( get_user_meta( $author_info->ID, 'user_primary_job', true ) ); // Converts the Primary Job output to lower case
			$user_type = preg_replace("![^a-z0-9]+!i", "-", $user_type ); // Converts spaces in the primary job to hyphens
		?>
	
		<li class="item vcard person <?php echo $user_type; if( $current_user->ID == $author_info->ID ) echo ' current-user'; ?>">
			<a class="card" href="#" data-reveal-id="<?php echo $author_info->ID; ?>" data-animation="fade" data-animationSpeed="12000">
			
				<img src="<?php echo cd_get_avatar($author_info->ID); ?>" class="avatar" height="150" width="150" alt="<?php echo $author_info->first_name; ?> <?php echo $author_info->last_name; ?>">
				
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

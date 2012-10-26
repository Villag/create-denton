<?php

// Count up all the users
$total_users = count_users();
$total_users = $total_users['total_users'];

// How many users to display per page
$number = 4;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Offset if the current page isn't 0 and define the max number of users to display
$args = array(
	'count_total' => true,
	'offset' => $paged ? ($paged * $number) : 0,
	'number' => $number
);

// Loop through the users
$users = get_users( $args );
foreach ( $users as $user ) {
	global $wp_query;
	$user_info = get_userdata( $user->ID );
	$all_meta_for_user = get_user_meta( $user->ID );
	$curauth = $wp_query->get_queried_object();

	$user_type = strtolower( get_user_meta( $user->ID, 'Primary Job', true ) );
	$user_type = preg_replace("![^a-z0-9]+!i", "-", $user_type );
	
	if ( !cd_is_valid_user( $user->ID ) ) continue; ?>
	
	<li class="item vcard person <?php echo $user_type; ?>">
				
		<a class="card" href="#<?php echo cd_clean_username( $user->ID ); ?>" role="button" data-toggle="modal">
			<?php echo get_avatar( $user->ID, '150'); ?>
			<header class="n brief" title="Name">
				<span class="fn" itemprop="name">
					<span class="given-name"><?php echo get_user_meta( $user->ID, 'first_name', true ); ?></span>
					<span class="family-name"><?php echo get_user_meta( $user->ID, 'last_name', true ); ?></span>
				</span> <!--/ .fn -->
				<div class="primary-job"><?php echo get_user_meta( $user->ID, 'Primary Job', true ); ?></div>
			</header> <!--/ .n -->
		</a><!-- .card -->
				
	</li><!-- .card -->

<?php

}
// Get the current page
$paged = get_query_var('paged');
// If there are more users than the number displayed, paginate
if($total_users > $number){

  $pl_args = array(
     'base'     => add_query_arg('paged','%#%'),
     'format'   => '',
     'total'    => floor($total_users / $number),
     'current'  => max(1, $paged),
  );

  // for ".../page/n"
  if($GLOBALS['wp_rewrite']->using_permalinks())
    $pl_args['base'] = user_trailingslashit(trailingslashit(get_pagenum_link(1)).'page/%#%/', 'paged');

  echo '<nav id="page-nav">'. paginate_links($pl_args) .'</nav>';
}
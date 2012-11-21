<?php
/**
 * Primary Sidebar Template
 *
 * The Primary sidebar template houses the HTML used for the 'Primary' sidebar.
 * It will first check if the sidebar is active before displaying anything.
 *
 * @package Hybrid
 * @subpackage Template
 * @link http://themehybrid.com/themes/hybrid/widget-areas
 */

if ( is_active_sidebar( 'profile' ) ) : ?>

	<div id="sidebar-profile">
		
		<ul class="unstyled">

		<?php dynamic_sidebar( 'profile' ); ?>
		
		</ul>

	</div><!-- #sidebar-profile -->

<?php endif; ?>
<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<div id="ie-modal">
	<div class="reveal-modal" role="dialog" aria-hidden="true" tabindex="-1" id="edit-profile" aria-labelledby="edit-profile-label" data-width="760">
		<div class="modal-header">
			<a class="close-reveal-modal">×</a>
			<h3 id="edit-profile-label">IE? Really?</h3>
		</div>
		<div class="modal-body">
			<p>BTW, no version of IE is supported in any real functional way. If you are using IE, than maybe this site is not for you! I'm kidding....but no really, IE sucks and we don't support it. Smiley Face.</p>
		</div>
		<a class="close-reveal-modal">×</a>
	</div><!-- / reveal-modal -->
</div><!-- / ie-modal -->
	</div><!-- #main .wrapper -->
</div><!-- #page -->

<?php get_template_part( 'modals' ); // Load modals.php ?>

<?php wp_footer(); ?>
<?php cd_first_timer(); ?>
</body>
</html>
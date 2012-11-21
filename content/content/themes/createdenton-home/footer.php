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
	</div><!-- #main .wrapper -->
</div><!-- #page -->

<?php get_template_part( 'modals' ); // Load modals.php ?>

<?php wp_footer(); ?>
<?php cd_first_timer(); ?>
</body>
</html>
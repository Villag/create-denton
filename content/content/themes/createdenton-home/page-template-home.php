<?php
/**
 * Template Name: Home
 */
add_action( 'wp_enqueue_scripts', 'cd_launch_scripts' );
function cd_launch_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'vegas', get_stylesheet_directory_uri() .'/js/jquery.vegas.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'launch', get_stylesheet_directory_uri() .'/js/launch.js', array( 'jquery' ), '1.0', true );
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php hybrid_document_title(); ?></title>
<?php wp_head(); ?>

<?php
/* Inserts Google Analytics script if not local environment */
if ( defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV == false ) { ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35667323-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php } ?>
</head>

<body <?php body_class(); ?>>
	
	<div id="intro">
	
		<h1>Create <strong>Denton</strong></h1>
		
		<h2><span>Stop</span> <span>Creating</span> Alone</h2>

	</div>
	
	<div id="subs" class="row-fluid">
		
		<a class="span4" href="/digital/">
			
			<div class="sub">
				
				<h2>Digital</h2>
				<div class="description">Enter</div>
			
			</div><!-- .sub -->
		
		</a><!-- .span4 -->

		<div class="span4 inactive">
		
			<div class="sub">
				
				<h2>Music</h2>
				<div class="description">(Coming Soon)</div>
			
			</div><!-- .sub -->
				
		</div><!-- .span4 -->
		
		<div class="span4 inactive">
		
			<div class="sub">
				
				<h2>Market</h2>
				<div class="description">(Coming Soon)</div>
			
			</div><!-- .sub -->
				
		</div><!-- .span4 -->

	</div>

<?php get_footer(); ?>
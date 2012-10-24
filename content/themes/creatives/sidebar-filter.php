<li id="filters" class="item filters">

	<h3 class="menu-toggle"><?php _e( 'Filter by type', 'create_denton' ); ?></h3>
	<p>
		<a class="btn btn-inverse menu-toggle" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
	</p>

	<div class="nav-collapse">
		<ul class="option-set clearfix corner-stamp" data-option-key="filter">
			<li class="illustrator">		<span class="legend"></span><a data-filter=".illustrator" href="#filter">Illustrator</a></li>
	        <li class="photographer">		<span class="legend"></span><a data-filter=".photographer" href="#filter">Photographer</a></li>
	        <li class="programmer">			<span class="legend"></span><a data-filter=".programmer" href="#filter">Programmer</a></li>
	        <li class="film-video">			<span class="legend"></span><a data-filter=".film-video" href="#filter">Film/Video</a></li>
	        <li class="writer">				<span class="legend"></span><a data-filter=".writer" href="#filter">Writer</a></li>
	        <li class="web-designer">		<span class="legend"></span><a data-filter=".web-designer" href="#filter">Web Designer</a></li>
	        <li class="graphic-designer">	<span class="legend"></span><a data-filter=".graphic-designer" href="#filter">Graphic Design</a></li>
	        <li class="fine-art">			<span class="legend"></span><a data-filter=".fine-arts" href="#filter">Fine Art</a></li>
	        <li class="other">				<span class="legend"></span><a data-filter=".other" href="#filter">Other</a></li>
	        <li class="reset">				<a href="#filter" data-filter="*" class="selected">Reset</a></li>
		</ul><!-- #filters.nav.nav-list -->
	</div><!-- .nav-collapse -->
</li><!-- .item.filters -->

<script>
	$(function() {
		var $container = $('#the-creatives');

		$container.isotope({
			itemSelector : '.item'
		});

		var $optionSets = $('#filters .option-set'), $optionLinks = $optionSets.find('a');

		$optionLinks.click(function() {
			var $this = $(this);
			// don't proceed if already selected
			if ($this.hasClass('selected')) {
				return false;
			}
			var $optionSet = $this.parents('.option-set');
			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected');

			var filters = $(this).data('filter');
			$container.isotope({
				filter : filters + ', .filters'
			});
		});

		/* Prepare for infinite scroll
		 $container.infinitescroll({
		 navSelector  : '#page_nav',    // selector for the paged navigation
		 nextSelector : '#page_nav a',  // selector for the NEXT link (to page 2)
		 itemSelector : '.element',     // selector for all items you'll retrieve
		 loading: {
		 finishedMsg: 'No more pages to load.',
		 img: 'http://i.imgur.com/qkKy8.gif'
		 }
		 },
		 // call Isotope as a callback
		 function( newElements ) {
		 $container.isotope( 'appended', $( newElements ) );
		 }
		 );
		 */
	});

</script>
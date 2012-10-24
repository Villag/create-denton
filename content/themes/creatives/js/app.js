jQuery(document).ready(function($) {

	$('.modal').on('show', function() {
		$('.site').blurjs();
		$(this).detach();
		//$(this).append(body);
	});
	$('.modal').on('hide', function() {
		window.location.hash = '';
		// for older browsers, leaves a # behind
		history.pushState('', document.title, window.location.pathname);
		$.blurjs('reset');
	});
	$('.card').click(function() {
		var hash = $(this).attr('href');
		window.location.hash = hash;
	});

	$(window.location.hash).modal('show');

});

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
			filter : filters + ', .filters',
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
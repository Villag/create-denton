jQuery(document).ready(function($) {

	// When the modal displays, blur the background
	$('.modal').on('show', function() {
		$('.site').blurjs();
	});

	// When the modal hides, remove the hash from the URL and unblur
	$('.modal').on('hide', function() {
		window.location.hash = '';
		history.pushState('', document.title, window.location.pathname);
		$.blurjs('reset');
	});

	// When a card is clicked, add its ID as a hash to the URL
	$('.card').click(function() {
		var hash = $(this).attr('href');
		window.location.hash = hash;
	});

	// Display a modal if the ID matches the hash in the URL
	$(window.location.hash).modal('show');

	// Filtering
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
				filter : filters + ', .sidebar',
			});
		});
	});

}); 
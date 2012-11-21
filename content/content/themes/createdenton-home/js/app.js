jQuery(document).ready(function($) {

	// When the modal hides, remove the hash from the URL and unblur
	$(".reveal-modal").bind('reveal:closed', function() {
		window.location.hash = '';
		history.pushState('', document.title, window.location.pathname);
	});

	// When an anchor is clicked, add its ID as a hash to the URL
	$('a').click(function() {
		var hash = $(this).data('reveal-id');
		if( hash != null ) {
			window.location.hash = hash;
		}
	});

	// Display a modal if the ID matches the hash in the URL
	$(window.location.hash).reveal('open');

	// Filtering
	$(function() {
		var $container = $('#the-creatives');

		$container.isotope({
			itemSelector : '.item'
		});

		var $optionSets = $('#filter .option-set'), $optionLinks = $optionSets.find('a');

		$optionLinks.click(function(event) {
			var $this = $(this);
			// don't proceed if already selected
			if ($this.hasClass('selected')) {
				return false;
			}
			var $optionSet = $this.parents('.option-set');
			$optionSet.find('.selected').removeClass('selected');
			$this.parent().addClass('selected');

			var filters = $(this).parent().data('filter');
			$container.isotope({
				filter : filters,
				onLayout : function($elems, instance) {
					if ($container.data('isotope').$filteredAtoms.length <= 1) {
						return false;
					}
				}
			});
			event.preventDefault();
		});

	});

});
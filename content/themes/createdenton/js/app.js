jQuery(document).ready(function($) {

	// When the modal hides, remove the hash from the URL and unblur
	$(".modal").on('hide.bs.modal', function() {
		history.pushState('', document.title, window.location.pathname);
	});

	// When an anchor is clicked, add its ID as a hash to the URL
	$('a').click(function() {
		var hash = $(this).data('id');
		if (hash != null) {
			window.location.hash = hash;
		}
	});

	// Display a modal if the ID matches the hash in the URL
	$(window.location.hash).modal('show');

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

	var avatar_local = $('#avatar-local');
	var avatar_social = $('#avatar-social');
	var avatar_gravatar = $('#avatar-gravatar');

	$('input:radio[name="input_11"]').change( function(){
		$(this).parent().siblings().removeClass('selected');
		$(this).parent().addClass('selected');
	});

	$('input:radio[name="input_11"][checked]').each( function() {
		$(this).parent().siblings().removeClass('selected');
		$(this).parent().addClass('selected');
	});

	if(avatar_local.length > 0) {
		$('input[value="avatar_upload"]').next().prepend(avatar_local);
	} else {
		// Don't hide the local version, even if one doesn't exist
	}

	if(avatar_social.length > 0) {
		$('input[value="avatar_social"]').next().prepend(avatar_social);
	} else {
		$('input[value="avatar_social"]').parent('li').hide();
	}

	if(avatar_gravatar.length > 0) {
		$('input[value="avatar_gravatar"]').next().prepend(avatar_gravatar);
	} else {
		$('input[value="avatar_gravatar"]').parent('li').hide();
	}

});
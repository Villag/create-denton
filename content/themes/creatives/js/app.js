$(function() {

	if ($('html').hasClass('csstransforms3d')) {

		$('.card').removeClass('scroll').addClass('flip');
		$('.card.flip').toggle(function() {
			$(this).find('.card-wrapper').addClass('flipIt');
		}, function() {
			$(this).find('.card-wrapper').removeClass('flipIt');
		});

	} else {

		$('.card').hover(function() {
			$(this).find('.card-back').stop().animate({
				bottom : 0
			}, 500, 'easeOutCubic');
		}, function() {
			$(this).find('.card-back').stop().animate({
				bottom : ($(this).height() * -1)
			}, 500, 'easeOutCubic');
		});
	}
});
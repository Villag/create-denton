jQuery(document).ready(function($) {

	$('.modal').on('show', function () {
		$('.site').blurjs();
		$(this).detach();
		//$(this).append(body);
	});
	$('.modal').on('hide', function () {
	    window.location.hash = ''; // for older browsers, leaves a # behind
	    history.pushState('', document.title, window.location.pathname);
	    $.blurjs('reset');
    });
	$('.card').click( function () {
		var hash = $(this).attr('href');
		window.location.hash = hash;
	});
	
	$(window.location.hash).modal('show');

});

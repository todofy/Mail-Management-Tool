$(document).ready(function(){
	var userMenu = $('.header-user-dropdown .header-user-menu');
	userMenu.on('touchend', function(e){
		userMenu.addClass('show');
		link = $('.header-user-dropdown .header-user-menu ul li a');
		link.on('touchend', function(e){
			window.location = $(this).attr("href");
			e.preventDefault();
			e.stopPropagation();
		});
		e.preventDefault();
		e.stopPropagation();
	});

	// This code makes the user dropdown work on mobile devices
	$(document).on('touchend', function(e){
		// If the page is touched anywhere outside the user menu, close it
		userMenu.removeClass('show');
	});

	$("#search").submit(function( event ) {
	    field = $('#search_key').val();
	    if($.trim(field)=="")
	    	return false;
	    else return true;
	});
});
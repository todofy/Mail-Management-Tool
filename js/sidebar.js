$(document).ready(function(){

	$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#main_icon").toggleClass('flip');
        $("#sidebar-wrapper").toggleClass('go-up');
        $("#content-wrapper").toggleClass('col-xs-10 col-xs-offset-2').toggleClass('col-xs-12');
    });

});
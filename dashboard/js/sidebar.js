$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        $("#wrapper").toggleClass("declick");
        $("#main_icon").toggleClass("flip");
        $("#menu-toggle").addClass("click");
        $("#header").toggleClass("push");
});
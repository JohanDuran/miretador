$(window).scroll(function () {

    var nav = $('.navbar-default');
    var scroll = $(window).scrollTop();
    var resolucion = $(document).width();

    if (scroll >= 20 && resolucion > 767) {
        nav.addClass("fondo-menu");
    } else {
        nav.removeClass("fondo-menu");
    }
});


$(document).on("click", ".alert", function(e) {
    bootbox.alert("Hello world!", function() {
        console.log("Alert Callback");
    });
});
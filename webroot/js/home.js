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
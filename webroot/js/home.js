/*
* Cambia la vista del menú al momento de hacer scroll
*/
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


/*
* funciones que verifican los campos de hora inicio y fin para una cancha al momento de insertarla
*/
function inicioChange() {
    var inicio = $('#inicio').val();
    var fin = $('#fin');
    fin.attr('min', inicio);
}

function finChange() {
    var fin = $('#fin').val();
    var inicio = $('#inicio');
    inicio.attr('max', fin);
}

/*
* verifica que el valor del campo hora inicio y fin no excedan los rangos permitidos
*/
function revisarNumero(elem){
    if(elem.value > 23){
        elem.value = elem.value.slice(0,elem.value.length-1); 
    }else if( inicio < 0){
         elem.value = 0;
    }
}


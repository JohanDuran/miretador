var cancha_me_gusta='';//esta variable es para el resultado de presionar add me gusta ya que indica el valor con el cuál eliminar posteriormente la cancha.


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




//utilizado para resetear el valor del buscador ya que se conserva al pasar entre páginas.
$(document).ready(function() {
    $("#autocompleteByName").val("");
    $("#autocompleteByName").attr("placeholder", "Ej: cancha Mí Retador...");    
})





//función utilizada para controlar el botón ME GUSTA de forma dinámica con ajax
function addFavorite(urlData) {
    $.ajax({
        type:"GET",
        url:urlData,
        dataType: 'json',
        async:true,
        success: function(response){
            if(response.state=='success'){
                $("#spn_me_gusta").hide();
                $("#spn_agregada").show();
                cancha_me_gusta=response.id;
            }        
        },
        error: function (response) {
            console.log('error getting the data');
        }
    });
}


//función utilizada para controlar el botón ME GUSTA de forma dinámica con ajax
function deleteFavorite(urlData) {
    if (cancha_me_gusta!=''){
        var res=urlData.split('/');
        urlData=res[0]+'/'+res[1]+'/'+res[2]+'/'+cancha_me_gusta;
    }
    
    $.ajax({
        type:"GET",
        url:urlData,
        dataType: 'json',
        async:true,
        success: function(response){
            if(response.state=='success'){
                $("#spn_me_gusta").show();
                $("#spn_agregada").hide();            
            }
        },
        error: function (response) {
            console.log('error getting the data');
        }
    });
}





//carga dínamica de los últimos partidos confirmados
function cargarPartidos() {
    $.ajax({
        type:"GET",
        url:'/UsersGames/viewAjax/',
        dataType: 'json',
        async:true,
        success: function(response){
            var data="";
            for(var i = 0; i < response.length;i++){
                var temp = "";
                var partido = response[i];
                data += "<tr><td>";
                var challenged = partido.challenged_name.name;
                temp = challenged.split(' ');
                challenged = temp[0];
                data += challenged;
                if(partido.challenger_name){
                    var challenger = partido.challenger_name.name;
                    temp = challenger.split(' ');
                    challenger = temp[0];
                    data+="</br>vs</br>"+challenger;
                }
                data+="</td>";
                var fecha = partido.meet;
                data+="<td>"+fecha+"</td>";
                var cancha = partido.field_name.name;
                data+="<td>"+cancha+"</td>";
                data+="</tr>";
            }
            $("#tbodyPartidos").empty();
            $("#tbodyPartidos").append(data);
        },
        error: function (response) {
            console.log('error getting the data');
        }
    });
}


setInterval(cargarPartidos, 120000);

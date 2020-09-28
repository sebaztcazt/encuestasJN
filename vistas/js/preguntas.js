/*==========================
SELECT TRAE LA DESCRIPCION @
==========================*/

$("#listaTipoPregunta").on("change", "select.nuevoTipoPregunta", function() {

    var id = $(this).val();

    $(this).attr("id", id);

    var datos = new FormData();
    datos.append("id", id);

    $.ajax({
        url: "ajax/preguntas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if (respuesta) {

                $(".descripcion").html(respuesta['Descripcion']);

            } else {

                $(".descripcion").html("");

                $("#listaValor").empty();

            }

        }
    });
});

/*==========================
EDITAR PREGUNTAS
==========================*/
$(document).on("click", ".btnEditarPregunta", function() {

    var idPregunta = $(this).attr("idPregunta");

    var datos = new FormData();
    datos.append("idPregunta", idPregunta);

    $.ajax({
        url: "ajax/preguntas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#editarTitulo").html(respuesta["TituloPregunta"]);
            $("#editarTitulo").val(respuesta["TituloPregunta"]);

            $("#editarDescripcion").html(respuesta["Descripcion"]);
            $("#editarDescripcion").val(respuesta["Descripcion"]);

            $("#editarIdPregunta").val(respuesta['IdPregunta']);

            if (respuesta['IdTipoPregunta'] == 3 && respuesta['IdTipoPregunta'] == 4){
    
                $("#editarTipoPregunta").html(respuesta['TipoPregunta']);
                $("#editarTipoPregunta").val(respuesta['IdTipoPregunta']);
    
            }else{

                $("#editarTipoPregunta").html('');
                $("#editarTipoPregunta").val('');

            }



        }
    });
})

/*==========================
SELECT TRAE LA DESCRIPCION PARA EDITAR
==========================*/
$("#editarlistaTipoPregunta").on("change", "select.editarTipoPregunta", function() {

    var id = $(this).val();

    $(this).attr("id", id);

    var datos = new FormData();
    datos.append("id", id);

    $.ajax({
        url: "ajax/preguntas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            console.log(respuesta);

            if (respuesta) {

                $(".editardescripcion").attr("placeholder", respuesta['Descripcion']);


            } else {

                $(".editardescripcion").html("");

                $("#editarlistaValor").empty();

            }

        }
    });
});

/*==========================
ELIMINAR PREGUNTA
==========================*/
$(document).on("click", ".btnEliminarPregunta", function() {

    var idPregunta = $(this).attr("idPregunta");

    var idEncuesta = $(this).attr("idEncuesta");


    Swal.fire({
        icon: "warning",
        title: '¿Esta seguro de borrar la pregunta?',
        text: "Si no lo està puede cancelar la acciòn!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Borrar pregunta',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=agregar-preguntas&idPregunta=" + idPregunta + '&idEncuesta=' + idEncuesta;
        }
    });
})


/*==========================
VER VALOR
==========================*/
$(document).on("click", ".btnVerValor", function() {

    var idPregunta = $(this).attr("idPregunta");


    $("#verIdPreguntaValor").val(idPregunta);

    $("#idPreguntaEliminar").val(idPregunta);

    var datos = new FormData();
    datos.append("idPregunta", idPregunta);

    $.ajax({
        url: "ajax/opciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            console.log(respuesta);

            for (let i = 0; i < 5; i++) {

                $("#verValorRadio" + i).html(respuesta[i]['Valor']);
                $("#verValorRadio" + i).val(respuesta[i]['Valor']);

            }
        }
    });

})

/*==========================
ELIMINAR VALORES
==========================*/
$(document).on("click", ".btnEliminarValores", function() {

    var idPregunta = document.getElementById("verIdPreguntaValor").value;

    var idEncuesta = $(this).attr("idEncuesta");

    Swal.fire({
        icon: "warning",
        title: '¿Esta seguro de borrar los valores?',
        text: "Si no lo està puede cancelar la acciòn!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Borrar valores',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=agregar-preguntas&idPreguntaValores=" + idPregunta + '&idEncuesta=' + idEncuesta;
        }
    });


})

/* =============================================================================================*/

/*==========================
BOTON PARA AGREGAR INPUTS EN EL MODAL VER VALOR
==========================*/

var camposMax = 10;
var x = 0;

$("#btnAgregarValorPregunta").click(function(e) {

    e.preventDefault();

    $("#guardarValores").removeAttr("disabled");

    if (x < camposMax) {

        $("#listarValorPregunta").append(

            '<div class="form-group">' +
            ' <div class="input-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text"> <button type="button" class="btn btn-danger btn-xs quitarValor"idOpcion"> <i class="fa fa-times"></i> </button> </span>' +
            '</div>' +
            '<input type="text" autocomplete="off" class="form-control input-lg" name="nuevoValorRadio[]"  placeholder="Ingrese Valor" required>' +
            '</div>' +
            '</div>'

        );

        x++;

        $("#guardarValores").removeAttr("disabled");
        
    }else{
        
    }
})

/*==========================
QUITAR INPUTS DEL MODAL AGREGAR
==========================*/
$(".formularioValor").on("click", "button.quitarValor", function() {

    $(this).parent().parent().parent().parent().remove();
    
    x--;

    if (x == 0) {
        $("#guardarValores").attr("disabled","true");
    }
}); 


/*==========================
AGREGAR VALOR AL INPUT HIDDEN AL DAR CLICK EN BOTON AGREGAR VALOR
==========================*/
$(document).on("click", ".btnAgregarValor", function() {

    var idPregunta = $(this).attr("idPregunta");

    $("#nuevoIdPreguntaValor").val(idPregunta);

})


/*==========================
VER VALOR
==========================*/
$(document).on("click", ".btnVerValor", function() {

    var idPregunta = $(this).attr("idPregunta");

    $("#verIdPreguntaValor").val(idPregunta);

    $("#idPreguntaEliminar").val(idPregunta);

    var datos = new FormData();
    datos.append("idPregunta", idPregunta);

    $.ajax({
        url: "ajax/opciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            var valores = respuesta.length

            for (let i = 0; i < valores; i++) {



                $("#listarVerValor").append(

                    '<div class="form-group">' +
                    ' <div class="input-group">' +
                    '<input type="text" class="form-control input-lg" name="verValorRadio[]" id="verValorRadio' + i +
                    '" autocomplete="off" placeholder="Ingrese valor" required >' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text"> <button type="button" idOpcion= class="btn btn-danger btn-xs quitarValor"> <i class="fa fa-times"></i> </button> </span>' +
                    '</div>' +
                    '</div>' +
                    '</div>'

                );

                $("#verValorRadio" + i).html(respuesta[i]['Valor']);
                $("#verValorRadio" + i).val(respuesta[i]['Valor']);


            }

            let params = new URLSearchParams(location.search);
            var contract = params.get('idEncuesta');


        }
    });

    $("#listarVerValor").empty();

})

$("#modalVerValor").on("click", "button.quitarValor", function() {

    $(this).parent().parent().parent().parent().remove();

});
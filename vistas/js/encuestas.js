/*==========================
ELIMINAR ENCUESTA
==========================*/

$(document).on("click",".btnEliminarEncuesta",function(){

    var idEncuesta = $(this).attr("idEncuesta");

    Swal.fire({
        icon: "warning",
        title: '¿Esta seguro de borrar la encuesta?',
        text: "Si no lo està puede cancelar la acciòn!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Borrar encuesta'
    }).then((result) => {
        if(result.value){
            window.location = "index.php?ruta=encuestas&idEncuesta="+idEncuesta;
        }
    });

})

/*==========================
EDITAR ENCUESTA
==========================*/

$(document).on("click", ".btnEditarEncuesta", function(){
    
    var idEncuesta = $(this).attr("idEncuesta");

    var datos = new FormData();
    datos.append("idEncuesta", idEncuesta);

    $.ajax({
        url: "ajax/encuestas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            
            $("#editarTitulo").val(respuesta["Titulo"]);
            $("#editarDescripcion").val(respuesta["Descripcion"]);

            var fechaInicio = moment(new Date(respuesta["FechaInicio"])).format('YYYY-MM-DDTHH:mm');
            var fechaFin = moment(new Date(respuesta["FechaFin"])).format('YYYY-MM-DDTHH:mm');

            
            $("#editarFechaInicio").val(fechaInicio);
            $("#editarFechaFin").val(fechaFin);

            $("#editarEstado").val(respuesta['Estado']);
            $("#editarIdEncuesta").val(respuesta['IdEncuesta']);
          
        }
    });
})




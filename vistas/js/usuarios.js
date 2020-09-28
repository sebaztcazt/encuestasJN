/*==========================
EVITAR REPETIR DOCUMENTO
==========================*/

$("#nuevoDocumento").change(function() {

    $(".alert").remove();

    var docId = $(this).val();

    var datos = new FormData();
    datos.append("validarDocumento", docId);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if (respuesta) {

                $("#nuevoDocumento").parent().after('<div class="alert alert-warning" style="text-aling: center;">Este Usuario ya existe en la base de datos</div>');

                $("#nuevoDocumento").val("");
            }
        }
    });
})

/*==========================
EDITAR USUARIO
==========================*/

$(document).on("click", ".btnEditarUsuario", function() {

    var docId = $(this).attr("idusuario");

    var datos = new FormData();
    datos.append("documento", docId);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#editarDocumento").val(respuesta["DocId"]);
            $("#editarNombre").val(respuesta["Nombre"]);
            $("#passwordActual,#editarPassword").val(respuesta["Password"]);

            $("#editarArea").html(respuesta['Area'])
            $("#editarArea").val(respuesta['IdArea'])

            $("#editarEmpresa").html(respuesta["Empresa"]);
            $("#editarEmpresa").val(respuesta["IdEmpresa"]);

            $("#editarTipoUsuario").html(respuesta["TipoUsuario"]);
            $("#editarTipoUsuario").val(respuesta["IdTipoUsuario"]);

            console.log(respuesta);
        }
    });
})

/*==========================
    ELIMINAR COLABORADOR
==========================*/

$(document).on("click", ".btnEliminarColaborador", function() {

    var docId = $(this).attr("idColaborador");

    console.log(docId);

    Swal.fire({
        icon: "warning",
        title: '¿Esta seguro de borrar el Colaborador?',
        text: "Si no lo està puede cancelar la acciòn!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Borrar Colaborador'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=colaboradores&docId=" + docId;
        }
    });

})

/*==========================
SI EL USUARIO EXISTE TRAER LOS DATOS
==========================*/

$("#documentoCliente").change(function() {
    var docId = $(this).val();

    let params = new URLSearchParams(location.search);
    var contract = params.get('idEncuesta');

    var datos = new FormData();
    datos.append("documento", docId);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {



            if (respuesta) {
                var nombre = respuesta["Nombre"];
                $("#NombrEempleado").val(nombre);

/*                 $.ajax({
                    url: "ajax/resultados.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta) {
                        

                        console.log(respuesta);

                        console.log(contract);

                        if (respuesta['RealEnc'] == contract) {

                            $(".alert").remove();

                            $("#NombrEempleado").parent().after('<div class="alert alert-warning" style="text-aling: center;">Este empleado ya respondio la encuesta</div>');

                        } else {

                            $(".alert").remove();

                            $("#NombrEempleado").parent().after('<div class="alert alert-success" style="text-aling: center;">Este empleado no a respondio la encuesta</div>');

                        }
                    }
                }); */




            } /* else {
                $("#NombrEempleado").val("");

                $(".alert").remove();

                $("#NombrEempleado").parent().after('<div class="alert alert-info" style="text-aling: center;">Este empleado no existe en la base de datos, revisa bien el documento</div>');

            } */
        }
    });
})
<?php

class ControladorPreguntas{

    /*========================
        MOSTRAR PREGUNTAS
    ======================*/

    static public function ctrMostrarPreguntas($item,$valor,$ordenar,$modo){

        $tabla = "tbpregunta";

        $respuesta = ModeloPreguntas::mdlMostrarPreguntas($item,$valor,$ordenar,$modo);

        return $respuesta;

    }

    /*========================
        MOSTRAR TIPO PREGUNTA
    ======================*/

    static public function ctrMostrarTipoPreguntas($item,$valor){

        $tabla = "tbtipopregunta";

        $respuesta = ModeloPreguntas::mdlMostrarTipoPreguntas($item,$valor,$tabla);

        return $respuesta;

    }

    /*========================
        AGREGAR PREGUNTA
	======================*/
    static public function ctrAgregarPregunta(){

       
        if (isset($_POST['nuevoTitulo'])) {

            $tabla = "tbpregunta";
            $datos = array(
            "idEncuesta" => $_POST['nuevoIdEncuesta'],
            "titulo" => $_POST['nuevoTitulo'],
            "descripcion" => $_POST['nuevaDescripcion'],
            "idTipoPregunta" => $_POST['nuevoTipoPregunta'],
            "requerido" => $_POST['nuevoRequerido']);

            $agregarPregunta = ModeloPreguntas::mdlAgregarPregunta($tabla,$datos);

            if ($agregarPregunta == "ok") {


                $tablaEncuesta = "tbencuesta";
                $datosEcuesta = array(
                "idEncuesta" => $_POST['nuevoIdEncuesta'],
                "estado" => 2);
            
                $cambiarEstadoEncuesta = ModeloEncuestas::mdlCambiarEstado($tablaEncuesta,$datosEcuesta);
            
                if ($cambiarEstadoEncuesta == "ok") {
            
                    echo '<script> 
                            Swal.fire({
                                icon: "success",
                                title: "La pregunta ha sido guardado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                                allowOutsideClick: false,
                                }).then((result)=>{
                                if(result.value){
                                    window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$_POST['nuevoIdEncuesta'].'";	
                                }
                            });
            
                        </script>';
                        
                    echo '<script>
            
                            Command: toastr["success"]("Se agrego '.$_POST["nuevoTitulo"].'")
            
                        </script>';  
                }
            
            }else {
                echo '<script> 
                        Swal.fire({
                            icon: "error",
                            title: "Ocurrio un error vuelva a intentarlo",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            allowOutsideClick: false,
                            }).then((result)=>{
                            if(result.value){
                                window.location ="encuestas";	
                            }
                        });

                    </script>';
            }


        }
    }
    

    /*========================
        EDITAR PREGUNTA
	======================*/
    static public function ctrEditarPregunta(){

        if (isset($_POST['editarTitulo'])) {

            $tabla = "tbpregunta";
            $datos = array(
            "idPregunta" => $_POST['editarIdPregunta'],
            "idEncuesta" => $_POST['editarIdEncuesta'],
            "titulo" => $_POST['editarTitulo'],
            "descripcion" => $_POST['editarDescripcion'],
            "idTipoPregunta" => $_POST['editarTipoPregunta'],
            "tituloEncuesta" => $_POST['tituloEncuesta'],
            "requerido" => $_POST['editarRequerido']);

            

            $respuesta = ModeloPreguntas::mdlEditarPregunata($tabla,$datos);

            if ($respuesta == "ok") {

                    echo '<script> 
                        Swal.fire({
                            icon: "success",
                            title: "La pregunta ha sido editada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            allowOutsideClick: false,
                            }).then((result)=>{
                            if(result.value){
                                window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$datos['idEncuesta'].'";	
                            }
                        });

                    </script>';
                    

            }else {
                
                echo '<script> 
                    Swal.fire({
                        icon: "error",
                        title: "Ocurrio un error vuelva a intentarlo",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false,
                        allowOutsideClick: false,
                    }).then((result)=>{
                        if(result.value){
                            window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$datos['idEncuesta'].'";	
                        }
                    });

                </script>';

            }

        }

    }
    
    /*========================
    	BORRAR PREGUNTA
    ==========================*/
    
    static public function ctrBorrarPregunta(){

		if(isset($_GET['idPregunta'])){

			$tabla = "tbpregunta";

            $datos = $_GET['idPregunta'];
            
            $url =  $_GET['idEncuesta'];

            $respuesta = ModeloPreguntas::mdlBorrarPregunta($tabla,$datos);
            

			if($respuesta == "ok"){

                echo '<script> 
                    
                    Swal.fire({
                        icon: "success",
                        title: "La pregunta ha sido borrado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false,
                        allowOutsideClick: false,
                    }).then((result)=>{
                        if(result.value){
                            window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$_GET['idEncuesta'].'";    
                        }
                    });

                </script>';

			}else if($respuesta[1] == 1451){

				echo '<script> 
                    
                    Swal.fire({
                        icon: "error",
                        title: "La pregunta no se puede borrar esta ya tiene preguntas asociadas, porfavor borre primero los valores!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false,
                        allowOutsideClick: false,
                    }).then((result)=>{
                        if(result.value){
                            window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$_GET['idEncuesta'].'";    
                        }
                    });

                </script>';

            }
            /*========================
            MIRAMOS SI LA ENCUESTA TIENE PREGUNTAS PARA CAMBIAR SU ESTADO
            ==========================*/

            $item = "IdEncuesta";
            $valor = $_GET['idEncuesta'];
            $ordenar = "IdPregunta";
            $modo = "ASC";

            $mostrarPreguntas = ModeloPreguntas::mdlMostrarPreguntas($item,$valor,$ordenar,$modo);

            if ($mostrarPreguntas == null) {

                $tablaEncuesta = "tbencuesta";
                $datosEcuesta = array(
                "idEncuesta" => $url,
                "estado" => 1);

                $cambiarEstadoEncuesta = ModeloEncuestas::mdlCambiarEstado($tablaEncuesta,$datosEcuesta); 

                if($cambiarEstadoEncuesta == "ok"){

                    echo '<script>

                    Command: toastr["info"]("Se cambio el estado de la encuesta")

                    </script>';  
    
                }
            }
        }
	}
}
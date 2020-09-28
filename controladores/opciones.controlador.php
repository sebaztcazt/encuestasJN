<?php

class ControladorOpciones{

    /*========================
    AGREGAR OPCIONES
    ==========================*/
    
    static public function ctrAgregarValorRadio(){

        if (isset($_POST['nuevoValorRadio'])) {

            $variableUrl = $_GET['idEncuesta'];

            $tabla = "tbopciones";
            $datos = array(
                "idPregunta" => $_POST['nuevoIdPreguntaValor'],
                "valorRadio" => $_POST['nuevoValorRadio']
            );

            $respuesta = ModeloOpciones::mdlmdlAgregarValorRadio($tabla,$datos);

            if ($respuesta == "ok") {

                echo '<script> 
                        Swal.fire({
                            icon: "success",
                            title: "Los valores se agregaron correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            }).then((result)=>{
                            if(result.value){
                                window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$variableUrl.'";	
                            }
                        });

                    </script>';
            }
        }

    }

    /*========================
        MOSTRAR OPCIONES
    ======================*/

    static public function ctrMostrarOpciones($item,$valor){

        $tabla = "tbopciones";

        $respuesta = ModeloOpciones::mdlMostrarOpciones($item,$valor);

        return $respuesta;

    }

    /*========================
        MOSTRAR UNA OPCION
    ======================*/

    static public function ctrMostrarUnaOpcion($item,$valor){

        $tabla = "tbopciones";

        $respuesta = ModeloOpciones::mdlMostrarUnaOpciones($item,$valor,$tabla);

        return $respuesta;

    }
    /*========================
        MOSTRAR OPCIONES TABLA
    ======================*/

    static public function ctrMostrarOpcionesTabla($item,$valor){

        $tabla = "tbopciones";

        $respuesta = ModeloOpciones::mdlMostrarOpcionesTabla($item,$valor);

        return $respuesta;

    }

    /*========================
    	BORRAR VALORES
	==========================*/

	static public function ctrBorrarValores(){

		if(isset($_GET['idPreguntaValores'])){

			$tabla = "tbopciones";

			$datos = $_GET['idPreguntaValores'];

			$respuesta = ModeloOpciones::mdlBorrarValores($tabla,$datos);

			if($respuesta == "ok"){

				echo '<script> 
                    
						Swal.fire({
							icon: "success",
							title: "Los valores han sido borrado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false,
						}).then((result)=>{
							if(result.value){
								window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$_GET['idEncuesta'].'";   
							}
						});

					</script>';
			}else if($respuesta[1] == 1451){

				echo '<script> 
                        swal({
                            icon: "error",
                            title: "Los valores no se puede borrar¡",
                            text: "Este ya tine registros asociados",
                            showConfirmButton: true,
                            confirmButtonText: "Ok",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value){
                                window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$_GET['idEncuesta'].'"; 
                            }
                        });
                    </script>';

			}
        }
    }


}
<?php

class ControladorResultados{

    /*========================
    AGREGAR RESULTADOS
    ==========================*/
    
    static public function ctrAgregarResultados(){

        if (isset($_POST['documentoCliente'])) {

            /*========================
            CONTAR CUANTAS PREGUNTAS HAY Y RESTAR
            ==========================*/

            $restaPreguntas = ($_POST['terminaIdPregunta'] - $_POST['numeroPreguntas']);

            for ($i= $restaPreguntas+1; $i <= $_POST['terminaIdPregunta'] ; $i++) { 

                $tabla = "tbresultados";

                $datos = array(
                    "idPregunta" => $i,
                    "valor" => $_POST[$i],
                    "idUsuario" => $_POST['documentoCliente'],
                    "idEncuesta" => $_GET['idEncuesta']
                    
                );

                $respuesta = ModeloResultados::mdlAgregarResultado($datos,$tabla);

            }
            if (isset($respuesta) && $respuesta == "ok") {

                echo '<script> 
                        Swal.fire({
                            icon: "success",
                            title: "La respuesta ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            }).then((result)=>{
                            if(result.value){
                                window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$_GET['idEncuesta'].'";    	
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
                    }).then((result)=>{
                        if(result.value){
                            window.location ="index.php?ruta=agregar-preguntas&idEncuesta='.$_GET['idEncuesta'].'";    	
                        }
                    });
                
                </script>';

            }

            
        }
        
    }
        
    /*========================
        MOSTRAR RESULTADOS
	======================*/
	
	static public function ctrMostrarResultados($item,$valor){

		$tabla = 'tbresultados';

		$respuesta = ModeloResultados::mdlMostrarResultados($tabla,$item,$valor);

		return $respuesta;

	}
  
}


    
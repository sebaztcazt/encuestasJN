<?php

class ControladorEncuestas{

    /*========================
        AGREGAR ENCUESTA
	======================*/
    static public function ctrAgregarEncuesta(){

        if (isset($_POST['nuevoTitulo'])) {

            if(preg_match('/^[0-9]+$/', $_POST["nuevoEstado"])){    

                $fechaInicio = strtotime($_POST['nuevaFechaInicio']);
                $fechaInicio = date("Y-m-d H:i:s", $fechaInicio);

                $fechaFin = strtotime($_POST['nuevaFechaFin']);
                $fechaFin = date("Y-m-d H:i:s", $fechaFin);

                

                $tabla = "tbencuesta";
                $datos = array(
                "titulo" => $_POST['nuevoTitulo'],
                "descripcion" => $_POST['nuevaDescripcion'],
                "estado" => $_POST['nuevoEstado'],
                "fechaInicio" => $fechaInicio,
                "fechaFin" => $fechaFin);

                $respuesta = ModeloEncuestas::mdlAgregarEncuesta($tabla,$datos);

                if ($respuesta == "ok") {

                    echo '<script> 
                            Swal.fire({
                                icon: "success",
                                title: "La Encuesta ha sido guardado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                            }).then((result)=>{
                                if(result.value){
                                    window.location ="encuestas";	
                                }
                            });

                        </script>';
                        
                    echo '<script>

                            Command: toastr["success"]("'.$_POST["nuevoTitulo"].' se creo")

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
                                window.location ="encuestas";	
                            }
                        });

                    </script>';

                }

                

            }else {

                echo '<script> 
							Swal.fire({
								icon: "warning",
								title: "La encuesta no puede ir vacío o llevar caracteres especiales",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false,
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
        MOSTRAR ENCUESTAS
    ======================*/
    
    static public function ctrMostratEncuestas($item,$valor){

        $tabla = "tbencuesta";

        $respuesta = ModeloEncuestas::mdlMostrarEncuestas($item,$valor,$tabla);

        return $respuesta;

    }

    /*========================
       BORRAR ENCUESTA
	======================*/

	static public function ctrBorrarEncuesta(){

		if(isset($_GET['idEncuesta'])){

			$tabla = "tbencuesta";

			$datos = $_GET['idEncuesta'];

			$respuesta = ModeloEncuestas::mdlBorrarEncuesta($tabla,$datos);

			if($respuesta == "ok"){

				echo '<script> 
                    
						Swal.fire({
							icon: "success",
							title: "La encuesta ha sido borrado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false,
						}).then((result)=>{
							if(result.value){
								window.location ="encuestas";    
							}
						});

					</script>';
			}else{	

                echo '<script> 
                    Swal.fire({
                        icon: "error",
                        title: "La encuesta no se puede borrar esta ya tiene preguntas asociadas!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false,
                    }).then((result)=>{
                        if(result.value){
                            window.location ="encuestas";    
                        }
                    });

                </script>';

            }
		}else{
           
        }
    }
    
     /*========================
        EDITAR ENCUESTA
	======================*/
    static public function ctrEditarEncuesta(){

        if (isset($_POST['editarTitulo'])) {

            $editarFechaInicio = strtotime($_POST['editarFechaInicio']);
            $editarFechaInicio = date("Y-m-d H:i:s", $editarFechaInicio);

            $editarFechaFin = strtotime($_POST['editarFechaFin']);
            $editarFechaFin = date("Y-m-d H:i:s", $editarFechaFin);

            

            $tabla = "tbencuesta";
            $datos = array(
            "idEncuesta" => $_POST["editarIdEncuesta"],
            "titulo" => $_POST['editarTitulo'],
            "descripcion" => $_POST['editarDescripcion'],
            "estado" => $_POST['editarEstado'],
            "fechaInicio" => $editarFechaInicio,
            "fechaFin" => $editarFechaFin);

            $respuesta = ModeloEncuestas::mdlEditarEncuesta($tabla,$datos);

            if ($respuesta == "ok") {
                    
                echo '<script> 
                
                        Swal.fire({
                            icon: "success",
                            title: "La encuesta ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                        }).then((result)=>{
                            if(result.value){
                                window.location ="encuestas";    
                            }
                        });

                    </script>';

            }else {

                echo '<script> 
                
                        Swal.fire({
                            icon: "error",
                            title: "Ocurrio un error vuelva a intentarlo!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                        }).then((result)=>{
                            if(result.value){
                                window.location ="encuestas";    
                            }
                        });

                    </script>';

            }

            

        }

    }
}
<?php

class ControladorColaboradores{

    /*========================
    	MOSTRAR COLABORADORES
	==========================*/
	
	static public function ctrMostrarColaboradores($item,$valor){

		$tabla = 'tbusuario';

		$respuesta = ModeloColaboradores::mdlMostrarColaboradores($tabla,$item,$valor);

		return $respuesta;

    }
	
	/*========================
    	AGREGAR COLABORADORES
	==========================*/
    static public function ctrAgregarColaborador(){

        if (isset($_POST['nuevoDocumento'])) {

            if (preg_match('/^[0-9]+$/', $_POST["nuevoDocumento"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre'])) {

                $tabla = "tbusuario";
				$datos = array(
					"documento" => $_POST['nuevoDocumento'],
					"nombre" => $_POST['nuevoNombre'],
					"password" => $_POST['nuevoDocumento'],
					"area" => $_POST['nuevaArea'],
					"empresa" => $_POST['nuevaEmpresa'],
					"tipoUsuario" => 2
                );
				
				$respuesta = ModeloColaboradores::mdlAgregarColaborador($tabla,$datos);

				if ($respuesta == "ok") {

					echo '<script> 
							Swal.fire({
								icon: "success",
								title: "El colaborador ha sido guardado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false,
					  		}).then((result)=>{
								if(result.value){
									window.location ="colaboradores";	
								}
							});

						</script>';
						
					echo '<script>

							Command: toastr["success"]("El colaborador '.$_POST["nuevoNombre"].' se agrego a la tabla")

						</script>';

				}else{

					echo '<script> 
					Swal.fire({
						icon: "error",
						title: "Ocurrio un error vuelva a intentarlo",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false,
					  }).then((result)=>{
						if(result.value){
							window.location ="colaboradores";	
						}
					});

				</script>';

				}

			}else{

				echo '<script> 
						Swal.fire({
							icon: "error",
							title: "El colaborador no puede ir vacío o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false,
						}).then((result)=>{
							if(result.value){
								window.location ="colaboradores";	
							}
						});

					</script>';

			}
     
        }

	}
	
	/*========================
    	BORRAR COLABORADORES
	==========================*/

	static public function ctrBorrarColaborador(){

		if(isset($_GET['docId'])){

			$tabla = "tbusuario";

			$datos = $_GET['docId'];

			$respuesta = ModeloColaboradores::mdlBorrarColaborador($tabla,$datos);

			if($respuesta == "ok"){

				echo '<script> 
                    
						Swal.fire({
							icon: "success",
							title: "El colaborador ha sido borrado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false,
						}).then((result)=>{
							if(result.value){
								window.location ="colaboradores";    
							}
						});

					</script>';
			}else if($respuesta[1] == 1451){

				echo '<script> 
                        swal({
                            icon: "error",
                            title: "El colaborador no se puede borrar¡",
                            text: "Este ya tine registros asociados",
                            showConfirmButton: true,
                            confirmButtonText: "Ok",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value){
                                window.location ="colaboradores";
                            }
                        });
                    </script>';

			}
		}

	}

}
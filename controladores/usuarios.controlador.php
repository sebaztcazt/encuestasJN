<?php

class ControladorUsuarios{

	/*======================================
    VERIFICAR SI EXISTE EL USUARIO PARA INICIAR SESION
    =====================================*/     

	static public function ctrIngresoUsuario(){

		if (isset($_POST["ingDocumento"])) {

			if(preg_match('/^[0-9]+$/', $_POST['ingDocumento'] )
				&& preg_match('/^[0-9]+$/', $_POST['ingPassword'] )){

				$tabla = 'tbusuario';

                $item = "DocId" ;
                $valor = $_POST['ingDocumento'];

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla , $item, $valor);

                if (is_array($respuesta)) {


                	if ($respuesta['DocId'] == $_POST['ingDocumento'] && $respuesta['Password'] == $_POST['ingPassword']) {

						if ($respuesta['IdTipoUsuario'] == 1) {

							$_SESSION['iniciarSesion'] = "ok";
                            $_SESSION["empleado"] = $respuesta["Nombre"];
                            $_SESSION["documento"] = $respuesta["DocId"];
			   
							echo 
								'<script>
								
									window.location =  "encuestas";

								</script>'
							;
							
						}else {

							echo '<div class="alert alert-warning" style="text-align: center;">Usuario no admitido</div>';
							
						}


                	}else{

                		echo '<div class="alert alert-warning" style="text-align: center;">Contraseña incorrecta, vuelve a intentarlo</div>';

                	}

				}else{

					echo '<div class="alert alert-danger" style="text-align: center;">El colaborador no existe</div>';

				}

			}

		}

	}

	/*========================
    MOSTRAR USUARIOS ADMINISTRADOR
	======================*/
	
	static public function ctrMostrarUsuarios($item,$valor){

		$tabla = 'tbusuario';

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);

		return $respuesta;

	}

	/*========================
        EDITAR USUARIOS
	==========================*/
	
	static public function ctrEditarUsuario(){

		if (isset($_POST['editarDocumento'])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarNombre'])) {

				if ($_POST['editarPassword'] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

						$password = $_POST['editarPassword'];

					}else{

						echo '<script> 
                            Swal.fire({
                                icon: "warning",
                                title: "La contraseña no puede ir vacío o llevar caracteres especiales",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                            }).then((result)=>{
                                if(result.value){
                                    window.location ="usuarios";    
                                }
                            });

                        </script>';

					}

				}else {
					
					$password = $_POST['passwordActual'];

				}

				$tabla = "tbusuario";

                $datos = array(
                    "documento" => $_POST['editarDocumento'],
                    "nombre" => $_POST['editarNombre'],
                    "password" => $password,
					"area" => $_POST['editarArea'],
					"empresa" => $_POST['editarEmpresa'],
					"tipoUsuario" => $_POST['editarTipoUsuario']
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla,$datos);

				if ($respuesta == "ok") {
                    
                    echo '<script> 
                    
                            Swal.fire({
                                icon: "success",
                                title: "El usuario ha sido editado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                            }).then((result)=>{
                                if(result.value){
                                    window.location ="usuarios";    
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
									window.location ="usuarios";    
								}
							});

						</script>';

				}

	
			}else{

				echo '<script> 
						Swal.fire({
							icon: "warning",
							title: "El usuario no puede ir vacio o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false,
						}).then((result)=>{
							if(result.value){
								window.location ="usuarios";    
							}
						});

					</script>';
				
			}

		}

	}


	/*========================
    	MOSTRAR AREAS
	==========================*/
	
	static public function ctrMostrarAreas($item,$valor){

		$tabla = 'tbarea';

		$respuesta = ModeloUsuarios::mdlMostrarAreas($tabla,$item,$valor);

		return $respuesta;

	}

	/*========================
    	MOSTRAR EMPRESAS
	==========================*/
	
	public function ctrMostrarEmpresas(){

		$tabla = 'tbempresa';

		$respuesta = ModeloUsuarios::mdlMostrarEmpresas($tabla);

		return $respuesta;

	}

	/*========================
    	MOSTRAR TIPO USUARIOS
	==========================*/
	
	static public function ctrMostrarTipoUsuarios($item,$valor){

		$tabla = 'tbtipousuario';

		$respuesta = ModeloUsuarios::mdlMostrarTipoUsuarios($tabla,$item,$valor);

		return $respuesta;

	}

} 
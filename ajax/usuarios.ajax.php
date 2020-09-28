<?php
require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';

class AjaxUsuarios{
    
    /*======================
    EVITAR REPETIR DOCUMENTO
    =========================*/

    public $docId;

    public function ajaxValidarDocumento(){

        $item = "DocId";
        $valor = $this->docId;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
        echo json_encode($respuesta);

    }

    /*======================
    EDITAR USUARIO
    =========================*/

    public function ajaxEditarUsuario(){

        $item = "docId";
        $valor = $this->docId;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
        echo json_encode($respuesta);
    }
}


/*======================
EVITAR REPETIR DOCUMENTO
=========================*/

if(isset($_POST["validarDocumento"])){

    $valDocumento = new AjaxUsuarios();
    $valDocumento ->  docId = $_POST["validarDocumento"];
    $valDocumento -> ajaxValidarDocumento();

}

/*======================
EDITAR USUARIO
=========================*/

if(isset($_POST["documento"])){

    $valDocumento = new AjaxUsuarios();
    $valDocumento ->  docId = $_POST["documento"];
    $valDocumento -> ajaxEditarUsuario();

}


<?php
require_once '../controladores/resultados.controlador.php';
require_once '../modelos/resultados.modelo.php';

class AjaxResultados{
    
    /*======================
    EVITAR REPETIR ENCUESTA
    =========================*/

    public $docId;

    public function ajaxValidarDocumento(){

        $item = "IdUsuario";
        $valor = $this->docId;
        $respuesta = ControladorResultados::ctrMostrarResultados($item,$valor);
        echo json_encode($respuesta);

    }
}


/*======================
EVITAR REPETIR DOCUMENTO
=========================*/

if(isset($_POST["documento"])){

    $valDocumento = new AjaxResultados();
    $valDocumento ->  docId = $_POST["documento"];
    $valDocumento -> ajaxValidarDocumento();

}


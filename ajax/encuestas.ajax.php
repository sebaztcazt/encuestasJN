<?php
require_once '../controladores/encuestas.controlador.php';
require_once '../modelos/encuestas.modelo.php';

class AjaxEncuestas{

    public $idEncuesta;

    public function ajaxMostarEncuesta(){

        $item = "Id";
        $valor = $this->idEncuesta;
        $respuesta = ControladorEncuestas::ctrMostratEncuestas($item,$valor);
        echo json_encode($respuesta);
    }

}

if(isset($_POST["idEncuesta"])){

    $idTipoPregunta = new AjaxEncuestas();
    $idTipoPregunta ->  idEncuesta = $_POST["idEncuesta"];
    $idTipoPregunta -> ajaxMostarEncuesta();
}
<?php

require_once '../controladores/preguntas.controlador.php';
require_once '../modelos/preguntas.modelo.php';

class AjaxPreguntas{

    public $id;
    public $idPregunta;

    public function ajaxTraerTipoPreguntas(){

        $item = "IdTipoPregunta";
        $valor = $this->id;
        $respuesta = ControladorPreguntas::ctrMostrarTipoPreguntas($item,$valor);
        echo json_encode($respuesta);

    }

    public function ajaxMostrarPreguntas(){

        $item = "idPregunta";
        $valor = $this->idPregunta;
        $ordenar = "IdPregunta";
        $modo = "ASC";
        $respuesta = ControladorPreguntas::ctrMostrarPreguntas($item,$valor,$ordenar,$modo);
        echo json_encode($respuesta);

    }

}
if(isset($_POST["id"])){

    $idTipoPregunta = new AjaxPreguntas();
    $idTipoPregunta ->  id = $_POST["id"];
    $idTipoPregunta -> ajaxTraerTipoPreguntas();
}

if(isset($_POST["idPregunta"])){

    $idTipoPregunta = new AjaxPreguntas();
    $idTipoPregunta ->  idPregunta = $_POST["idPregunta"];
    $idTipoPregunta -> ajaxMostrarPreguntas();
}
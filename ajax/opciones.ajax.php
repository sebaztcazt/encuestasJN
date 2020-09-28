<?php

require_once '../controladores/opciones.controlador.php';
require_once '../modelos/opciones.modelo.php';

class AjaxOpciones{

    public $idPregunta;

    public function ajaxMostrarOpciones(){

        $item = "IdPregunta";
        $valor = $this->idPregunta;
        $respuesta = ControladorOpciones::ctrMostrarUnaOpcion($item,$valor);
        echo json_encode($respuesta);
    }
}

if(isset($_POST["idPregunta"])){

    $idOpciones = new AjaxOpciones();
    $idOpciones ->  idPregunta = $_POST["idPregunta"];
    $idOpciones -> ajaxMostrarOpciones();
}
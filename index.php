<?php

/*======================================
         CONTROLADORES
=====================================*/ 
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/colaboradores.controlador.php";
require_once "controladores/encuestas.controlador.php";
require_once "controladores/preguntas.controlador.php";
require_once "controladores/opciones.controlador.php";
require_once "controladores/resultados.controlador.php";

/*======================================
         MODELOS
=====================================*/ 

require_once "modelos/usuarios.modelo.php";
require_once "modelos/colaboradores.modelo.php";
require_once "modelos/encuestas.modelo.php";
require_once "modelos/preguntas.modelo.php";
require_once "modelos/opciones.modelo.php";
require_once "modelos/resultados.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
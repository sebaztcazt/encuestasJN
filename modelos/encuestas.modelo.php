<?php

require_once "conexion.php";

class ModeloEncuestas{

    /*======================================
            AGREGAR ENCUESTAS
    =====================================*/

    static public function mdlAgregarEncuesta($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Titulo,Descripcion,Estado,FechaInicio,FechaFin) VALUES(:Titulo, :Descripcion, :Estado, :FechaInicio, :FechaFin)");

        $stmt -> bindParam(":Titulo", $datos['titulo'], PDO::PARAM_STR);
        $stmt -> bindParam(":Descripcion", $datos['descripcion'], PDO::PARAM_STR);
        $stmt -> bindParam(":Estado", $datos['estado'], PDO::PARAM_INT);
        $stmt -> bindParam(":FechaInicio", $datos['fechaInicio'], PDO::PARAM_STR);
        $stmt -> bindParam(":FechaFin", $datos['fechaFin'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            
            return "ok";

        }else{

            return $stmt->errorinfo();

        }

        $stmt = null;
             
    } 

    /*======================================
            MOSTRAR ENCUESTAS
    =====================================*/ 
    static public function mdlMostrarEncuestas($item,$valor,$tabla){

    	if($item != null){
    		
            $stmt = Conexion::conectar()->prepare("SELECT e.Id AS 'IdEncuesta',  e.Titulo AS 'Titulo', e.Descripcion AS 'Descripcion', e.Estado AS 'Estado', e.FechaInicio AS 'FechaInicio', e.FechaFin AS 'FechaFin' FROM tbencuesta AS e WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();
        }else{

            $stmt = Conexion::conectar()->prepare("SELECT e.Id AS 'IdEncuesta', e.Titulo AS 'Titulo', e.Descripcion AS 'Descripcion', e.Estado AS 'Estado', e.FechaInicio AS 'FechaInicio', e.FechaFin AS 'FechaFin' FROM tbencuesta AS e ");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;

    }

    /*======================================
            BORRAR ENCUESTA
    =====================================*/

    static public function mdlBorrarEncuesta($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE Id = :IdEncuesta");

        $stmt -> bindParam(":IdEncuesta", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {
            
            return "ok";

        }else{

            return $stmt->errorinfo();

        }

        $stmt = null;

    }

    /*======================================
            EDITAR ENCUESTAS
    =====================================*/

    static public function mdlEditarEncuesta($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET Titulo = :Titulo, Descripcion = :Descripcion, Estado = :Estado, FechaInicio = :FechaInicio, FechaFin = :FechaFin WHERE Id = :IdEncuesta ");

        $stmt -> bindParam(":IdEncuesta", $datos['idEncuesta'], PDO::PARAM_INT);
        $stmt -> bindParam(":Titulo", $datos['titulo'], PDO::PARAM_STR);
        $stmt -> bindParam(":Descripcion", $datos['descripcion'], PDO::PARAM_STR);
        $stmt -> bindParam(":Estado", $datos['estado'], PDO::PARAM_INT);
        $stmt -> bindParam(":FechaInicio", $datos['fechaInicio'], PDO::PARAM_STR);
        $stmt -> bindParam(":FechaFin", $datos['fechaFin'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            
            return "ok";

        }else{

            return $stmt->errorinfo();

        }

        $stmt = null;
             
    } 

    /*======================================
            ECAMBIAR ESTADO ENCUESTA
    =====================================*/

    static public function mdlCambiarEstado($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET Estado = :Estado  WHERE Id = :IdEncuesta ");

        $stmt -> bindParam(":IdEncuesta", $datos['idEncuesta'], PDO::PARAM_INT);
        $stmt -> bindParam(":Estado", $datos['estado'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            
            return "ok";

        }else{

            return $stmt->errorinfo();

        }

        $stmt = null;
             
    } 

}
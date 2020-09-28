<?php

require_once "conexion.php";

class ModeloPreguntas{
    
    /*========================
        MOSTRAR PREGUNTAS
    ======================*/

    static public function mdlMostrarPreguntas($item,$valor,$ordenar,$modo){

        if($item == "idPregunta"){
    		
            $stmt = Conexion::conectar()->prepare("SELECT p.IdPregunta AS 'IdPregunta', p.IdEncuesta AS 'IdEncuesta', e.Titulo AS 'TituloEncuesta', p.Titulo AS 'TituloPregunta', p.Descripcion AS 'Descripcion', tp.IdTipoPregunta AS 'IdTipoPregunta', tp.Nombre AS 'TipoPregunta', p.Requerido AS 'Requerdio' FROM tbpregunta AS p INNER JOIN tbencuesta AS e ON p.IdEncuesta=e.Id INNER JOIN tbtipopregunta AS tp On p.IdTipoPregunta=tp.IdTipoPregunta WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }
        elseif($item == "IdEncuesta"){

            $stmt = Conexion::conectar()->prepare("SELECT p.IdPregunta AS 'IdPregunta', e.Id AS 'IdEncuesta', e.Titulo AS 'TituloEncuesta', p.Titulo AS 'TituloPregunta', p.Descripcion AS 'Descripcion', tp.IdTipoPregunta AS 'IdTipoPregunta', tp.Nombre AS 'TipoPregunta', p.Requerido AS 'Requerido' FROM tbpregunta AS p INNER JOIN tbencuesta AS e ON p.IdEncuesta=e.Id INNER JOIN tbtipopregunta AS tp On p.IdTipoPregunta=tp.IdTipoPregunta WHERE $item = :$item  ORDER BY $ordenar $modo");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;

    }

    /*========================
        MOSTRAR TIPO PREGUNTA
    ==========================*/

    static public function mdlMostrarTipoPreguntas($item,$valor,$tabla){

        if($item != null){
    		
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();
        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;

    }

    /*======================================
            AGREGAR PREGUNTAS
    =====================================*/

    static public function mdlAgregarPregunta($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(IdEncuesta,Titulo,Descripcion,IdTipoPregunta,Requerido) VALUES(:IdEncuesta, :Titulo, :Descripcion, :IdTipoPregunta, :Requerido)");

        $stmt -> bindParam(":IdEncuesta", $datos['idEncuesta'], PDO::PARAM_INT);
        $stmt -> bindParam(":Titulo", $datos['titulo'], PDO::PARAM_STR);
        $stmt -> bindParam(":Descripcion", $datos['descripcion'], PDO::PARAM_STR);
        $stmt -> bindParam(":IdTipoPregunta", $datos['idTipoPregunta'], PDO::PARAM_INT);
        $stmt -> bindParam(":Requerido", $datos['requerido'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            
            return "ok";

        }else{

            return $stmt->errorinfo();

        }

        $stmt = null;
             
    } 

    /*======================================
            EDITAR PREGUNTAS
    =====================================*/

    static public function mdlEditarPregunata($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET Titulo = :Titulo, Descripcion = :Descripcion, IdTipoPregunta = :IdTipoPregunta, Requerido = :Requerido  WHERE IdPregunta = :idPregunta ");

        $stmt -> bindParam(":idPregunta", $datos['idPregunta'], PDO::PARAM_INT);
        $stmt -> bindParam(":Titulo", $datos['titulo'], PDO::PARAM_STR);
        $stmt -> bindParam(":Descripcion", $datos['descripcion'], PDO::PARAM_STR);
        $stmt -> bindParam(":IdTipoPregunta", $datos['idTipoPregunta'], PDO::PARAM_INT);
        $stmt -> bindParam(":Requerido", $datos['requerido'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            
            return "ok";

        }else{

            return $stmt->errorinfo();

        }

        $stmt = null;
             
    } 

    /*======================================
            BORRAR PREGUNTAS
    =====================================*/

    static public function mdlBorrarPregunta($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdPregunta = :IdPregunta");

        $stmt -> bindParam(":IdPregunta", $datos, PDO::PARAM_INT);

        if ($stmt -> execute()) {
        
            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt = null;

    }



}
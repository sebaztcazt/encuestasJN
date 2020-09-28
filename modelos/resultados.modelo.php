<?php

require_once "conexion.php";

class ModeloResultados{

    /*========================
    AGREGAR RESULTADOS
    ==========================*/

    static public function mdlAgregarResultado($datos,$tabla){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(IdPregunta,Valor,IdUsuario,RealEnc) VALUES(:IdPregunta,:Valor,:IdUsuario,:RealEnc)");

        $stmt -> bindParam(":IdPregunta", $datos['idPregunta'], PDO::PARAM_INT);
        $stmt -> bindParam(":Valor", $datos['valor'], PDO::PARAM_STR);
        $stmt -> bindParam(":IdUsuario", $datos['idUsuario'], PDO::PARAM_STR);
        $stmt -> bindParam(":RealEnc", $datos['idEncuesta'], PDO::PARAM_INT);

        if ($stmt -> execute()) {
        
            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt = null;
    }



    /*======================================
            MOSTRAR RESULTADOS  
    =====================================*/ 

    static public function mdlMostrarResultados($tabla,$item,$valor){

    	if($item != null){
    		
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();
        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;

    }




}
<?php

require_once "conexion.php";

class ModeloColaboradores{

    /*======================================
            MOSTRAR COLABORADORES
    =====================================*/ 
    static public function mdlMostrarColaboradores($tabla,$item,$valor){

    	if($item != null){
    		
            $stmt = Conexion::conectar()->prepare("SELECT u.DocId AS 'DocId', u.Password AS 'Password', u.Nombre AS 'Nombre', a.IdArea AS 'IdArea', a.Nombre AS 'Area', e.IdEmpresa AS 'IdEmpresa', e.Nombre  AS 'Empresa', tp.Nombre AS 'IdTipoUsuario' FROM tbusuario AS u INNER JOIN tbarea AS a ON u.IdArea = a.IdArea INNER JOIN tbempresa AS e ON u.IdEmpresa = e.IdEmpresa INNER JOIN tbtipousuario AS tp ON u.IdTIpoUsuario = tp.IdTipoUsuario WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();
        }else{

            $stmt = Conexion::conectar()->prepare("SELECT u.DocId AS 'DocId', u.Password AS 'Password', u.Nombre AS 'Nombre', a.Nombre AS 'Area', e.Nombre  AS 'Empresa', tp.Nombre AS 'IdTipoUsuario' FROM tbusuario AS u INNER JOIN tbarea AS a ON u.IdArea = a.IdArea INNER JOIN tbempresa AS e ON u.IdEmpresa = e.IdEmpresa INNER JOIN tbtipousuario AS tp ON u.IdTIpoUsuario = tp.IdTipoUsuario");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;

    }

    /*======================================
            AGREGAR COLABORADORES
    =====================================*/

    static public function mdlAgregarColaborador($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(DocId,Nombre,Password,IdArea,IdEmpresa,IdTipoUsuario) VALUES(:DocId, :Nombre, :Password, :Area, :Empresa, :IdTipoUsuario)");

        $stmt -> bindParam(":DocId", $datos['documento'], PDO::PARAM_INT);
        $stmt -> bindParam(":Nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt -> bindParam(":Password", $datos['password'], PDO::PARAM_STR);
        $stmt -> bindParam(":Area", $datos['area'], PDO::PARAM_INT);
        $stmt -> bindParam(":Empresa", $datos['empresa'], PDO::PARAM_STR);
        $stmt -> bindParam(":IdTipoUsuario", $datos['tipoUsuario'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            
            return "ok";

        }else{

            return $stmt->errorinfo();

        }

        $stmt = null;
             
    } 

    /*======================================
            BORRAR COLABORADORES
    =====================================*/

    static public function mdlBorrarColaborador($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE DocId = :DocId");

        $stmt -> bindParam(":DocId", $datos, PDO::PARAM_INT);

        if ($stmt -> execute()) {
        
            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt = null;

    }
}
<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*======================================
        MOSTRAR USUARIOS ADMINISTRADOR
    =====================================*/ 

    static public function mdlMostrarUsuarios($tabla,$item,$valor){

    	if($item != null){
    		
            $stmt = Conexion::conectar()->prepare("SELECT u.DocId AS 'DocId', u.Password AS 'Password', u.Nombre AS 'Nombre', a.IdArea AS 'IdArea', a.Nombre AS 'Area', e.IdEmpresa AS 'IdEmpresa', e.Nombre  AS 'Empresa', tp.Nombre AS 'TipoUsuario', u.IdTipoUsuario AS 'IdTipoUsuario' FROM tbusuario AS u INNER JOIN tbarea AS a ON u.IdArea = a.IdArea INNER JOIN tbempresa AS e ON u.IdEmpresa = e.IdEmpresa INNER JOIN tbtipousuario AS tp ON u.IdTIpoUsuario = tp.IdTipoUsuario  WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();
        }else{

            $stmt = Conexion::conectar()->prepare("SELECT u.DocId AS 'DocId', u.Password AS 'Password', u.Nombre AS 'Nombre', a.Nombre AS 'Area', e.Nombre  AS 'Empresa', tp.Nombre AS 'IdTipoUsuario' FROM tbusuario AS u INNER JOIN tbarea AS a ON u.IdArea = a.IdArea INNER JOIN tbempresa AS e ON u.IdEmpresa = e.IdEmpresa INNER JOIN tbtipousuario AS tp ON u.IdTIpoUsuario = tp.IdTipoUsuario WHERE u.IdTipoUsuario = 1");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;

    }

    /*======================================
            EDITAR USUARIOS
    =====================================*/

    static public function mdlEditarUsuario($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET Nombre = :Nombre, Password = :Password, IdArea = :IdArea, IdEmpresa = :IdEmpresa, IdTipoUsuario = :IdTipoUsuario WHERE DocId = :DocId");

        $stmt -> bindParam(":DocId", $datos['documento'], PDO::PARAM_INT);
        $stmt -> bindParam(":Nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt -> bindParam(":Password", $datos['password'], PDO::PARAM_STR);
        $stmt -> bindParam(":IdArea", $datos['area'], PDO::PARAM_INT);
        $stmt -> bindParam(":IdEmpresa", $datos['empresa'], PDO::PARAM_STR);
        $stmt -> bindParam(":IdTipoUsuario", $datos['tipoUsuario'], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else {
            return $stmt->errorInfo();
        }

        $stmt = null;

    }


    /*======================================
            MOSTRAR AREAS
    =====================================*/ 

    static public function mdlMostrarAreas($tabla,$item,$valor){

    	if($item != null){
    		
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item,$valor,PDO::PARAM_STR);

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
            MOSTRAR EMPRESAS
    =====================================*/ 

    static public function mdlMostrarEmpresas($tabla){
    	
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt = null;

    }

    /*======================================
            MOSTRAR TIPO USUARIOS   
    =====================================*/ 

    static public function mdlMostrarTipoUsuarios($tabla,$item,$valor){


        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item,$valor,PDO::PARAM_STR);
    
            $stmt -> execute();
    
            return $stmt -> fetchAll();
        }else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
    
            $stmt -> execute();
    
            return $stmt -> fetchAll();
        }
    	


        $stmt = null;

    }

}
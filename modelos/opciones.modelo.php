<?php

require_once "conexion.php";

class ModeloOpciones{

    /*========================
    AGREGAR OPCIONES
    ==========================*/

    static public function mdlmdlAgregarValorRadio($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(IdPregunta,Valor) VALUES(:IdPregunta,:Valor)");

        foreach ($datos['valorRadio'] as $key => $value) {

            $stmt->bindParam(":IdPregunta", $datos['idPregunta'], PDO::PARAM_INT);

            $stmt->bindParam(":Valor", $value, PDO::PARAM_STR);
            
            if (!$stmt->execute()) {
                return "error";
            }
        }

        return "ok";

        $stmt = null;
    }

    /*========================
        MOSTRAR OPCIONES
    ======================*/

    static public function mdlMostrarOpciones($item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT o.IdPregunta AS 'IdPregunta', p.Titulo AS 'TituloPregunta', p.Descripcion AS 'Descripcion', p.IdTipoPregunta AS 'IdTipoPregunta', o.IdOpcion AS 'IdOpcion', o.Valor AS 'Valor' FROM tbopciones o INNER JOIN tbpregunta AS p ON p.IdPregunta = o.IdPregunta  WHERE o.$item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();
        
        $stmt = null;

    }

    /*========================
        MOSTRAR UNA OPCIONE
    ======================*/

    static public function mdlMostrarUnaOpciones($item,$valor,$tabla){

        $stmt = Conexion::conectar()->prepare("SELECT o.IdPregunta AS 'IdPregunta', p.Titulo AS 'TituloPregunta', p.Descripcion AS 'Descripcion', p.IdTipoPregunta AS 'IdTipoPregunta', o.IdOpcion AS 'IdOpcion', o.Valor AS 'Valor' FROM tbopciones o INNER JOIN tbpregunta AS p ON p.IdPregunta = o.IdPregunta  WHERE o.$item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetchAll();
        
        $stmt = null;

    }

    /*========================
        MOSTRAR UNA OPCION PARA GUARDAR
    ======================*/

    static public function mdlMostrarUnaOpcionGuardar($valor,$i,$tablaOpciones){

        $stmt = Conexion::conectar()->prepare("SELECT o.IdPregunta AS 'IdPregunta', p.Titulo AS 'TituloPregunta', p.Descripcion AS 'Descripcion', p.IdTipoPregunta AS 'IdTipoPregunta', o.IdOpcion AS 'IdOpcion', o.Valor AS 'Valor' FROM tbopciones o INNER JOIN tbpregunta AS p ON p.IdPregunta = o.IdPregunta  WHERE o.IdOpcion = :IdOpcion AND o.IdPregunta = :IdPregunta");

        $stmt -> bindParam(":IdOpcion", $valor, PDO::PARAM_INT);
        $stmt -> bindParam(":IdPregunta", $i, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch();
        
        $stmt = null;

    }

    /*========================
        MOSTRAR OPCIONES TABLA
    ======================*/

    static public function mdlMostrarOpcionesTabla($item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT o.IdPregunta AS 'IdPregunta', p.Titulo AS 'TituloPregunta', p.Descripcion AS 'Descripcion', p.IdTipoPregunta AS 'IdTipoPregunta', o.IdOpcion AS 'IdOpcion', o.Valor AS 'Valor' FROM tbopciones o INNER JOIN tbpregunta AS p ON p.IdPregunta = o.IdPregunta  WHERE o.$item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();
        
        $stmt = null;

    }


    /*======================================
            BORRAR VALORES
    =====================================*/

    static public function mdlBorrarValores($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdPregunta = :IdPregunta");

        $stmt -> bindParam(":IdPregunta", $datos, PDO::PARAM_INT);

        if ($stmt -> execute()) {
        
            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt = null;

    }

    /*======================================
            AGREGAR OPCION A TP 1 Y 2
    =====================================*/

    static public function mdlAgregarOpcion($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(IdPregunta,Valor) VALUES(:IdPregunta,:Valor)");

        $stmt->bindParam(":IdPregunta", $datos['idPregunta'], PDO::PARAM_STR);
        $stmt->bindParam(":Valor", $datos['valorRadio'], PDO::PARAM_STR);

        if ($stmt -> execute()) {
        
            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt = null;

    }

    static public function mdlAgregarTextoOpciones($valor,$i,$tablaTexto){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tablaTexto(IdPregunta,Valor) VALUES(:IdPregunta,:Valor)");

        $stmt->bindParam(":IdPregunta", $i, PDO::PARAM_STR);
        $stmt->bindParam(":Valor", $valor, PDO::PARAM_STR);

        if ($stmt -> execute()) {
        
            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt = null;

    }

    static public function mdlMostrarTextoGuardar($i,$tablaTexto){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM tbtexto WHERE IdPregunta = :IdPregunta");

        $stmt -> bindParam(":IdPregunta", $i, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch();
        
        $stmt = null;

    }



}
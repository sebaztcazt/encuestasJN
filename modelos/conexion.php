<?php

class Conexion{

    /*======================================
    CONEXION A LA BASE DE DATOS PHPMYADMIND
    =====================================*/

    static public function conectar(){

        $link = new PDO("mysql:host=localhost;dbname=db_encuestasjn",
                        "root",
                        "");
                
        $link->exec("set names utf8");

        return $link;

    }
    
}

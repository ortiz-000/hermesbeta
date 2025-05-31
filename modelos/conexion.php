<?php

class Conexion{

    static public function conectar(){
<<<<<<< HEAD
        $link = new PDO("mysql:host=localhost;dbname=hermes002", "root", "");

        
=======
        $link = new PDO("mysql:host=localhost;dbname=hermes002", "root", "root");
>>>>>>> 0e26592232cd53c5e3bd9c58120100869179db01
        $link -> exec("set names utf8");
        return $link;
    }
}
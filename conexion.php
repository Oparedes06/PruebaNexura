<?php

class conexion {
    public static function Conectar(){
        $servername = "localhost";
        $database = "pruebanexura";
        $username = "root";
        $password = "";

        $conn = new PDO('mysql:host='.$servername.';dbname='.$database.';charset=utf8', $username, $password);

        return $conn;
    }
}
?>
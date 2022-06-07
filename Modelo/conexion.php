<?php

class Conexion{
    public static $conexion;
    public static function Conectar(){
        self::$conexion = mysqli_connect('localhost', 'root', '', 'project_mvc');
        return self::$conexion;
    }
}




?>
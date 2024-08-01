<?php 
    $servidor = "localhost";
    $baseDeDatos = "app";
    $usuario = "root";
    $password = "";

    try{
        $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$password);
        }catch (Exception $ex){
            echo $ex->getMessage();
        }

?> 
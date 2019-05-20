<?php

// -- CONECTAR SMBD

// -- SELECCIONAR bd

// -- EJECUTAR CONSULTAS

// -- PROCESAR EL RESULTADO

// -- CERRAR CONEXIÓN


    function conectar(){

        $parametros = parse_ini_file("configuracion.ini");

        $servidor = $parametros['servidor'];
        $user =  $parametros['user'];
        $password =  $parametros['password'];
        $db = $parametros['db'];

        $con = mysqli_connect($servidor, $user, $password, $db);
        return $con;
    }
    function ejecutarConsulta($con, $sql){
        $query = mysqli_query($con, $sql);
        return $query;
    }
    function cerrar($con){
        mysqli_close($con);
    }

?>


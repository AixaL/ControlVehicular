<?php

// include("conexion.php");
include("../conexion.php");
$con = conectar();

if($_POST['table'] != null && $_POST['conditional'] != null && $_POST['param'] != null){
    $table = $_POST['table'];
    $conditional = $_POST['conditional'];
    $param = $_POST['param'];
    $sql = "SELECT * FROM $table WHERE $conditional = $param";
} else if($_POST['table']) {
    $table = $_POST['table'];
    $sql = "SELECT * FROM $table";
} else {
    echo("No params were sent");
}

$query = ejecutarConsulta($con, $sql);

$status = mysqli_affected_rows($con);
if($status == -1){
    echo("Consulta fallida \n");
} else if($status == 0) {
    echo ("Sin resultados \n");
} else if($status > 0){
    echo($status . " resultados encontrados </br>");
    $results = [];
    while($fila = mysqli_fetch_row($query)){

        array_push($results,$fila);
        
    }
    print_r($results);
}


cerrar($con);



















?>
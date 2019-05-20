<?php 

	// $idReporte = $_POST['idReporte'];
	$vehiculo = $_POST['vehiculo'];
	$lugar = $_POST['lugar'];
	$fecha = $_POST['fecha'];
	$status = $_POST['status'];

	include("../conexion.php");
	$con = conectar();

	$sql = "INSERT INTO robos(Vehiculo, Lugar, Fecha, Estado) VALUES ('$vehiculo', '$lugar', '$fecha', '$status');";

	$query = ejecutarConsulta($con, $sql);
	if($query){
		echo("Consulta ejecutada \n");
	} else {
		echo ("Consulta fallida \n");
	}
	cerrar($con);
	
	// print('Numero de reporte: ' . $idReporte . '</br>');
	print('Vehiculo: ' . $vehiculo . '</br>');
	print('Lugar: ' . $lugar . '</br>');
	print('Fecha: ' . $fecha . '</br>');
	print('Status: ' . $status . '</br>');


?>
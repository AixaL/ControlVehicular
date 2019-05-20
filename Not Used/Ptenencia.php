<?php 

	// $folio = $_POST['folio'];
	$vehiculo = $_POST['vehiculo'];
	$periodo = $_POST['periodo'];
	$fechaPago = $_POST['fechaPago'];
	$monto = $_POST['monto'];
	$antiguedad = $_POST['antiguedad'];
	$descuento = $_POST['descuento'];

	include("../conexion.php");
	$con = conectar();

	$sql = "INSERT INTO tenencias(Vehiculo, Periodo, FechaPago, Monto, Antiguedad, Descuento) VALUES ('$vehiculo', '$periodo', '$fechaPago', '$monto', '$antiguedad', '$descuento');";

	$query = ejecutarConsulta($con, $sql);
	if($query){
		echo("Consulta ejecutada \n");
	} else {
		echo ("Consulta fallida \n");
	}

	cerrar($con);
		
	// print('Folio: ' . $folio . '</br>');
	print('Vehiculo: ' . $vehiculo . '</br>');
	print('Periodo: ' . $periodo . '</br>');
	print('Fecha de pago: ' . $fechaPago . '</br>');
	print('Monto: ' . $monto . '</br>');
	print('Antiguedad: ' . $antiguedad . '</br>');
	print('Descuento: ' . $descuento . '</br>');


?>
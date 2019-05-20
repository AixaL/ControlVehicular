<?php 
	// AUTENTIFICACIÓN
	include('../acceso/auth.php');

	$RFC = $_POST['RFC'];
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];

	include("../conexion.php");
	$con = conectar();

	$sql = "INSERT INTO propietarios VALUES ('$RFC', '$nombre', '$direccion', '$telefono', '$correo');";

	$query = ejecutarConsulta($con, $sql);
	$status = mysqli_affected_rows($con);
	if($status != -1){
		echo("Consulta ejecutada \n");
	} else {
		echo ("Consulta fallida \n");
	}
	cerrar($con);
	
	print('RFC: ' . $RFC . '</br>');
	print('Nombre: ' . $nombre . '</br>');
	print('Direcci�n: ' . $direccion . '</br>');
	print('Tel�fono: ' . $telefono . '</br>');
	print('Correo: ' . $correo . '</br>');


?>
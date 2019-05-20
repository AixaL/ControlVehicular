<?php 
	// AUTENTIFICACIÓN
	include('../acceso/auth.php');

	$nombre = $_POST['nombre'];
	$domicilio = $_POST['domicilio'];
	$sexo = $_POST['sexo'];
	$restricciones = $_POST['restricciones'];
	$telEmergencia = $_POST['telEmergencia'];
	
	include("../conexion.php");
	$con = conectar();

	$sql = "UPDATE conductores SET nombre='$nombre', domicilio='$domicilio', telEmergencia='$telEmergencia', sexo='$sexo', restricciones='$restricciones' WHERE idConductor='$idConductor';";

	$query = ejecutarConsulta($con, $sql);
	$status = mysqli_affected_rows($con);
	if($status != -1){
		echo("Consulta ejecutada \n");
	} else {
		echo ("Consulta fallida \n");
	}
		
	cerrar($con);

?>
<?php 
	// AUTENTIFICACIÓN
	include('../acceso/auth.php');


	$RFC = $_POST['RFC'];
	$nombre = $_POST['nombre'];
	$fechaNacimiento = $_POST['fechaNacimiento'];
	$firma = "";
	$domicilio = $_POST['domicilio'];
	$antiguedad = $_POST['antiguedad'];
	$sexo = $_POST['sexo'];
	$tipoSangre = $_POST['tipoSangre'];
	$restricciones = $_POST['restricciones'];
	$telEmergencia = $_POST['telEmergencia'];
	
	include("../conexion.php");
	$con = conectar();

	$sql = "INSERT INTO conductores VALUES ('$RFC', '$nombre', '$fechaNacimiento', '$firma', '$domicilio', '$antiguedad', '$telEmergencia', '$sexo', '$tipoSangre', '$restricciones');";

	$query = ejecutarConsulta($con, $sql);
	$status = mysqli_affected_rows($con);
	if($status != -1){

		$config = parse_ini_file("../configuracion.ini");

		if(!$xml = simplexml_load_file($config['temp'])){

			//No existe el archivo de base de datos aún.

			$xml = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?> <licencias></licencias>');

			$conductores = $xml->addChild('conductores');

			$conductor = $conductores->addChild('conductor');
			$conductor->addChild('RFC', $RFC);
			$conductor->addChild('nombre', $nombre);
			$conductor->addChild('fechaNacimiento', $fechaNacimiento);
			$conductor->addChild('firma', $firma);
			$conductor->addChild('domicilio', $domicilio);
			$conductor->addChild('antiguedad', $antiguedad);
			$conductor->addChild('sexo', $sexo);
			$conductor->addChild('tipoSangre', $tipoSangre);
			$conductor->addChild('restricciones', $restricciones);
			$conductor->addChild('telEmergencia', $telEmergencia);

			echo $xml->asXML($config['temp']);

		
		} else if( $xml->conductores != null ){

			//Existe el archivo xml y también la sección de conductores.

			$conductor = $xml->conductores->addchild('conductor');

			$conductor->addChild('RFC', $RFC);
			$conductor->addChild('nombre', $nombre);
			$conductor->addChild('fechaNacimiento', $fechaNacimiento);
			$conductor->addChild('firma', $firma);
			$conductor->addChild('domicilio', $domicilio);
			$conductor->addChild('antiguedad', $antiguedad);
			$conductor->addChild('sexo', $sexo);
			$conductor->addChild('tipoSangre', $tipoSangre);
			$conductor->addChild('restricciones', $restricciones);
			$conductor->addChild('telEmergencia', $telEmergencia);

			echo $xml->asXML($config['temp']);
		} else {

			//Sí existe el archivo xml pero no existe la sección de conductores.

			$conductores = $xml->addChild('conductores');

			$conductor = $conductores->addChild('conductor');
			$conductor->addChild('RFC', $RFC);
			$conductor->addChild('nombre', $nombre);
			$conductor->addChild('fechaNacimiento', $fechaNacimiento);
			$conductor->addChild('firma', $firma);
			$conductor->addChild('domicilio', $domicilio);
			$conductor->addChild('antiguedad', $antiguedad);
			$conductor->addChild('sexo', $sexo);
			$conductor->addChild('tipoSangre', $tipoSangre);
			$conductor->addChild('restricciones', $restricciones);
			$conductor->addChild('telEmergencia', $telEmergencia);

			echo $xml->asXML($config['temp']);
		}

		echo("Consulta ejecutada \n");
	} else {
		echo ("Consulta fallida \n");
	}
		
	cerrar($con);

	// print('RFC: ' . $RFC . '</br>');
	// print('Nombre: ' . $nombre . '</br>');
	// print('fechaNacimiento: ' . $fechaNacimiento . '</br>');
	// print('Firma: ' . $firma . '</br>');
	// print('Domicilio: ' . $domicilio . '</br>');
	// print('Antiguedad: ' . $antiguedad . '</br>');
	// print('Sexo: ' . $sexo . '</br>');
	// print('Tipo de sangre: ' . $tipoSangre . '</br>');
	// print('Restricciones: ' . $restricciones . '</br>');
	// print('Telefono: ' . $telEmergencia . '</br>');

	

?>
<?php 
	// AUTENTIFICACIÓN
	include('../acceso/auth.php');

	// $idVerificacion = $_POST['idVerificacion'];
	$vehiculo = $_POST['vehiculo'];
	$periodo = $_POST['periodo'];
	$tipo = $_POST['tipo'];
	$centroVerificador = $_POST['centroVerificador'];
	$dictamen = $_POST['dictamen'];

	include("../conexion.php");
	$con = conectar();

	$sql = "INSERT INTO verificaciones(Vehiculo, Periodo, CentroVerificacion, Tipo, Dictamen) VALUES ('$vehiculo', '$periodo', '$centroVerificador', '$tipo', '$dictamen');";

	$query = ejecutarConsulta($con, $sql);
	if($query){
		$idVerificacion = mysqli_insert_id($con);
		$xml = simplexml_load_file('../db.xml');

		if($xml === FALSE){

			//No existe el archivo de base de datos aún.
	
			$xml = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?> <db></db>');
	
			$verificaciones = $xml->addChild('verificaciones');
	
			$verificacion = $verificaciones->addChild('verificacion');
			$verificacion->addChild('idVerificacion', $idVerificacion);
			$verificacion->addChild('vehiculo', $vehiculo);
			$verificacion->addChild('periodo', $periodo);
			$verificacion->addChild('tipo', $tipo);
			$verificacion->addChild('centroVerificador', $centroVerificador);
			$verificacion->addChild('dictamen', $dictamen);
	
			echo $xml->asXML('../db.xml');
	
		
		} else if( $xml->verificaciones ){
	
			//Existe el archivo xml y también la sección de verificaciones.
	
			$verificacion = $xml->verificaciones->addchild('verificacion');
			$verificacion->addChild('idVerificacion', $idVerificacion);
			$verificacion->addChild('vehiculo', $vehiculo);
			$verificacion->addChild('periodo', $periodo);
			$verificacion->addChild('tipo', $tipo);
			$verificacion->addChild('centroVerificador', $centroVerificador);
			$verificacion->addChild('dictamen', $dictamen);	
	
			echo $xml->asXML('../db.xml');
		} else {
	
			//Sí existe el archivo xml pero no existe la sección de verificaciones.
	
			$verificaciones = $xml->addChild('verificaciones');
			$verificacion = $verificaciones->addChild('verificacion');
	
			$verificacion->addChild('idVerificacion', $idVerificacion);
			$verificacion->addChild('vehiculo', $vehiculo);
			$verificacion->addChild('periodo', $periodo);
			$verificacion->addChild('tipo', $tipo);
			$verificacion->addChild('centroVerificador', $centroVerificador);
			$verificacion->addChild('dictamen', $dictamen);
			
			echo $xml->asXML('../db.xml');
		}
		echo("Consulta ejecutada \n");
	} else {
		echo ("Consulta fallida \n");
	}
	cerrar($con);


?>
<?php 
	// AUTENTIFICACIÓN
	include('../acceso/auth.php');

	// $folio = 1;
	$conductor = $_POST['conductor'];
	$tipoLicencia = $_POST['tipoLicencia'];
	$fechaEmision = $_POST['fechaEmision'];
	$fechaVencimiento = $_POST['fechaVencimiento'];
	$estadoEmision = $_POST['estadoEmision'];

	include("../conexion.php");
	$con = conectar();

	$sql = "INSERT INTO licencias VALUES ('', '$conductor', '$tipoLicencia', '$fechaEmision', '$fechaVencimiento', '$estadoEmision');";

	$query = ejecutarConsulta($con, $sql);
	// $status = mysqli_affected_rows($con);
	if($query){

		// INICIO: Generación de XML
		$folio = mysqli_insert_id($con);
		$config = parse_ini_file("../configuracion.ini");
		$xml = simplexml_load_file($config['temp']);

		if($xml === FALSE){

			//No existe el archivo de base de datos aún.
	
			$xml = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?> <db></db>');
	
			$licencias = $xml->addChild('licencias');
	
			$licencia = $licencias->addChild('licencia');
			$licencia->addChild('conductor', $conductor);
			$licencia->addChild('tipoLicencia', $tipoLicencia);
			$licencia->addChild('fechaEmision', $fechaEmision);
			$licencia->addChild('fechaVencimiento', $fechaVencimiento);
			$licencia->addChild('estadoEmision', $estadoEmision);
	
			echo $xml->asXML('../db.xml');
	
		
		} else if( $xml->licencias != null ){
	
			//Existe el archivo xml y también la sección de licencias.
	
			$licencia = $xml->licencias->addchild('licencia');
	
			$licencia->addChild('conductor', $conductor);
			$licencia->addChild('tipoLicencia', $tipoLicencia);
			$licencia->addChild('fechaEmision', $fechaEmision);
			$licencia->addChild('fechaVencimiento', $fechaVencimiento);
			$licencia->addChild('estadoEmision', $estadoEmision);
	
	
	
			echo $xml->asXML('../db.xml');
		} else {
	
			//Sí existe el archivo xml pero no existe la sección de licencias.
	
			$licencias = $xml->addChild('licencias');
	
			$licencia = $licencias->addChild('licencia');
			$licencia->addChild('conductor', $conductor);
			$licencia->addChild('tipoLicencia', $tipoLicencia);
			$licencia->addChild('fechaEmision', $fechaEmision);
			$licencia->addChild('fechaVencimiento', $fechaVencimiento);
			$licencia->addChild('estadoEmision', $estadoEmision);
	
			echo $xml->asXML('../db.xml');
		}
		// FIN: Generación de XML
		// INICIO: Generación de QR
		require "../phpqrcode/qrlib.php";

		$qrData = "Folio: $folio Conductor: $conductor Vigencia: $fechaVencimientos";
		$filename = "licencia" . $folio . ".png";

		QRCode::png($qrData, $filename, "L");

		// FIN: Generación de QR



		echo("Consulta ejecutada </br>");
	} else {
		echo ("Consulta fallida </br>");
	}
	

	cerrar($con);

?>
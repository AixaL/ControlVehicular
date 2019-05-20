<?php 
	// AUTENTIFICACIÓN
	include('../acceso/auth.php');

	// $folio = $_POST['folio'];
	$idVerificacion = $_POST['idVerificacion'];
	$idVehiculo = $_POST['idVehiculo'];
	$licencia = $_POST['licencia'];
	$motivo = $_POST['motivo'];
	$emisor = $_POST['emisor'];
	$fecha = $_POST['fecha'];
	$monto = $_POST['monto'];
	$descripcion = $_POST['descripcion'];
	$garantia = $_POST['garantia'];

	include("../conexion.php");
	$con = conectar();
    $sql = "INSERT INTO multas VALUES ('', '$idVerificacion', '$idVehiculo', '$licencia', '$motivo', '$emisor', '$fecha', '$monto', '$descripcion', '$garantia');";
	$query = ejecutarConsulta($con, $sql);


	// $status = mysqli_affected_rows($con);
	if($query){
		$folio = mysqli_insert_id($con);
		$config = parse_ini_file("../configuracion.ini");
		$xml = simplexml_load_file($config['temp']);

		if($xml === FALSE){

			//No existe el archivo de base de datos aún.
	
			$xml = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?> <db></db>');
	
			$multas = $xml->addChild('multas');
	
			$multa = $multas->addChild('multa');
			$multa->addChild('idVerificacion', $idVerificacion);
			$multa->addChild('idVehiculo', $idVehiculo);
			$multa->addChild('licencia', $licencia);
			$multa->addChild('motivo', $motivo);
			$multa->addChild('emisor', $emisor);
			$multa->addChild('fecha', $fecha);
			$multa->addChild('monto', $monto);
			$multa->addChild('descripcion', $descripcion);
			$multa->addChild('garantia', $garantia);
	
	
			echo $xml->asXML('../db.xml');
	
		
		} else if( $xml->multas != null ){
	
			//Existe el archivo xml y también la sección de multas.
	
			$multa = $xml->multas->addchild('multa');
			$multa->addChild('idVerificacion', $idVerificacion);
			$multa->addChild('idVehiculo', $idVehiculo);
			$multa->addChild('licencia', $licencia);
			$multa->addChild('motivo', $motivo);
			$multa->addChild('emisor', $emisor);
			$multa->addChild('fecha', $fecha);
			$multa->addChild('monto', $monto);
			$multa->addChild('descripcion', $descripcion);
			$multa->addChild('garantia', $garantia);		
	
			echo $xml->asXML('../db.xml');
		} else {
	
			//Sí existe el archivo xml pero no existe la sección de multas.
	
			$multas = $xml->addChild('multas');
	
			$multa = $multas->addChild('multa');
			$multa->addChild('idVerificacion', $idVerificacion);
			$multa->addChild('idVehiculo', $idVehiculo);
			$multa->addChild('licencia', $licencia);
			$multa->addChild('motivo', $motivo);
			$multa->addChild('emisor', $emisor);
			$multa->addChild('fecha', $fecha);
			$multa->addChild('monto', $monto);
			$multa->addChild('descripcion', $descripcion);
			$multa->addChild('garantia', $garantia);
	
			echo $xml->asXML('../db.xml');
		}

		require('../barcode.php');
		$filepath="barras". $folio .".png";
		$text="folio";
		$size=40;
		$orientation="horizontal";
		$code_type="Code39";
		$print=true;
		$sizefactor="1";

		barcode($filepath, $text, $size, $orientation, $code_type, $print,$sizefactor);
		// $pdf->Image($filepath,170,10,0,0,'PNG');
		
		echo("Consulta ejecutada \n");
	} else {
		echo ("Consulta fallida \n");
	}
	
	cerrar($con);
	
	// print("Folio: " . $folio . "</br>");
	// print("Verificacion: " . $idVerificacion . "</br>");
	// print("Vehiculo: " . $idVehiculo . "</br>");
	// print("Licencia: " . $licencia . "</br>");
	// print("Motivo: " . $motivo . "</br>");
	// print("Emisor: " . $emisor . "</br>");
	// print("Fecha: " . $fecha . "</br>");
	// print("Monto: " . $monto . "</br>");
	// print("Descripcion: " . $descripcion . "</br>");
	// print("garantia: " . $garantia . "</br>");

?>
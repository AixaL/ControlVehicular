<?php 

	// AUTENTIFICACIÓN
	include('../acceso/auth.php');

	// $idVehiculo = "";
	$propietario = $_POST['propietario'];
	$placa = $_POST['placa'];
	$NIV = $_POST['NIV'];
	$tipo = $_POST['tipo'];
	$color = $_POST['color'];
	$uso = $_POST['uso'];
	$numeroPuertas = $_POST['numPuerta'];
	$marca = $_POST['marca'];
	$numeroMotor = $_POST['numMotor'];
	$numeroSerie = $_POST['numSerie'];
	$modelo = $_POST['modelo'];
	$combustible = $_POST['combustible'];
	$anio = $_POST['anio'];
	$cilindros = $_POST['cilindros'];
	$transmision = $_POST['transmision'];
	$linea = $_POST['linea'];
	$origen = $_POST['origen'];
	
	include("../conexion.php");
	$con = conectar();
	$sql = "INSERT INTO vehiculos(Propietario, NIV, Placa, Tipo, Color, Uso, numPuerta, Marca, numMotor, numSerie, Modelo, Combustible, Anio, Cilindraje, Transmision, Linea, Origen) VALUES ('$propietario', '$placa', '$NIV', '$tipo', '$color', '$uso', '$numeroPuertas', '$marca', '$numeroMotor', '$numeroSerie', '$modelo', '$combustible', '$anio', '$cilindros', '$transmision', '$linea', '$origen');";
	$query = ejecutarConsulta($con, $sql);

	if($query){
		$idVehiculo = mysqli_insert_id($con);
		$config = parse_ini_file("../configuracion.ini");
		$xml = simplexml_load_file($config['temp']);

		if($xml === FALSE){

			//No existe el archivo de base de datos aún.
	
			$xml = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?> <db></db>');
	
			$vehiculos = $xml->addChild('vehiculos');
	
			$vehiculo = $vehiculos->addChild('vehiculo');
			$vehiculo->addChild('idVehiculo', $idVehiculo);
			$vehiculo->addChild('propietario', $propietario);
			$vehiculo->addChild('placa', $placa);
			$vehiculo->addChild('NIV', $NIV);
			$vehiculo->addChild('tipo', $tipo);
			$vehiculo->addChild('color', $color);
			$vehiculo->addChild('uso', $uso);
			$vehiculo->addChild('numeroPuertas', $numeroPuertas);
			$vehiculo->addChild('marca', $marca);
			$vehiculo->addChild('numeroMotor', $numeroMotor);
			$vehiculo->addChild('numeroSerie', $numeroSerie);
			$vehiculo->addChild('modelo', $modelo);
			$vehiculo->addChild('combustible', $combustible);
			$vehiculo->addChild('anio', $anio);
			$vehiculo->addChild('cilindros', $cilindros);
			$vehiculo->addChild('transmision', $transmision);
			$vehiculo->addChild('linea', $linea);
			$vehiculo->addChild('origen', $origen);
			
			echo $xml->asXML('../db.xml');
	
		
		} else if( $xml->vehiculos ){

			//Existe el archivo xml y también la sección de vehiculos.
	
			$vehiculo = $xml->vehiculos->addchild('vehiculo');
			$vehiculo->addChild('idVehiculo', $idVehiculo);
			$vehiculo->addChild('propietario', $propietario);
			$vehiculo->addChild('placa', $placa);
			$vehiculo->addChild('NIV', $NIV);
			$vehiculo->addChild('tipo', $tipo);
			$vehiculo->addChild('color', $color);
			$vehiculo->addChild('uso', $uso);
			$vehiculo->addChild('numeroPuertas', $numeroPuertas);
			$vehiculo->addChild('marca', $marca);
			$vehiculo->addChild('numeroMotor', $numeroMotor);
			$vehiculo->addChild('numeroSerie', $numeroSerie);
			$vehiculo->addChild('modelo', $modelo);
			$vehiculo->addChild('combustible', $combustible);
			$vehiculo->addChild('anio', $anio);
			$vehiculo->addChild('cilindros', $cilindros);
			$vehiculo->addChild('transmision', $transmision);
			$vehiculo->addChild('linea', $linea);
			$vehiculo->addChild('origen', $origen);
	
			echo $xml->asXML('../db.xml');
		} else {
	
			//Sí existe el archivo xml pero no existe la sección de vehiculos.
	
			$vehiculos = $xml->addChild('vehiculos');
			$vehiculo = $vehiculos->addChild('vehiculo');
	
			$vehiculo->addChild('idVehiculo', $idVehiculo);
			$vehiculo->addChild('propietario', $propietario);
			$vehiculo->addChild('placa', $placa);
			$vehiculo->addChild('NIV', $NIV);
			$vehiculo->addChild('tipo', $tipo);
			$vehiculo->addChild('color', $color);
			$vehiculo->addChild('uso', $uso);
			$vehiculo->addChild('numeroPuertas', $numeroPuertas);
			$vehiculo->addChild('marca', $marca);
			$vehiculo->addChild('numeroMotor', $numeroMotor);
			$vehiculo->addChild('numeroSerie', $numeroSerie);
			$vehiculo->addChild('modelo', $modelo);
			$vehiculo->addChild('combustible', $combustible);
			$vehiculo->addChild('anio', $anio);
			$vehiculo->addChild('cilindros', $cilindros);
			$vehiculo->addChild('transmision', $transmision);
			$vehiculo->addChild('linea', $linea);
			$vehiculo->addChild('origen', $origen);
			
			echo $xml->asXML('../db.xml');
		}

		// INICIO: Generación de QR
		require "../phpqrcode/qrlib.php";

		$qrData = "Id: $idVehiculo Propietario: $propietario NIV: $NIV";
		$filename = "vehiculo" . $idVehiculo . ".png";

		QRCode::png($qrData, $filename, "L");

		// FIN: Generación de QR

		echo("Consulta ejecutada \n");
	} else {
		echo ("Consulta fallida \n");
	}
	cerrar($con);
	
	// print('Id: ' . $idVehiculo . '</br>');
	// print('Propietario: ' . $propietario . '</br>');
	// print('Numero de identificacion vehicular: ' . $NIV . '</br>');
	// print('Placa: ' . $placa . '</br>');
	// print('Tipo de vehiculo: ' . $tipo . '</br>');
	// print('Color: ' . $color . '</br>');
	// print('Uso: ' . $uso . '</br>');
	// print('Numero de puertas: ' . $numeroPuertas . '</br>');
	// print('Marca: ' . $marca . '</br>');
	// print('Numero de motor: ' . $numeroMotor . '</br>');
	// print('Numero de serie: ' . $numeroSerie . '</br>');
	// print('Modelo: ' . $modelo . '</br>');
	// print('Combustible: ' . $combustible . '</br>');
	// print('A�o: ' . $anio . '</br>');
	// print('Cilindros: ' . $cilindros . '</br>');
	// print('Transmision: ' . $transmision . '</br>');
	// print('Linea: ' . $linea . '</br>');
	// print('Origen: ' . $origen . '</br>');


?>
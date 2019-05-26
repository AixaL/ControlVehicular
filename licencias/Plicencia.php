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
	$status = mysqli_affected_rows($con);
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

		//INICIO: Generación de PDF
		//Obtención de datos
		$sql3 = "Select * from licencias WHERE Folio = $folio;";
		$query3 = ejecutarConsulta($con, $sql3);
		$fila = mysqli_fetch_row($query3);

		$sql4 = "Select * from conductores WHERE RFC = $fila[1];";
		$query4 = EjecutarConsulta($con, $sql4);
		$fila2 = mysqli_fetch_row($query4);

		//Creación de la licencia

		require('fpdf/fpdf.php');
		$pdf = new FPDF();
		$pdf->AddPage();
		//PARTE DELANTERA
		$pdf->SetFont('Arial','B',6);
		$pdf->Rect(1,1,80,110);
		//Logotipo Querétaro
		$pdf->Image('Queretaro.png', 5, 3, 10, 12);
		$pdf->SetXY(20,3);
		$pdf->MultiCell(80,3," Estados Unidos Mexicanos \n Poder Ejecutivo del Estado de Queretaro \n Secretaria de Seguridad Ciudadana \n Licencia para conducir",0,'L');
		$pdf->SetXY(68,5);
		$pdf->SetFont('Arial','B',30);
		//Variable tipo
		$pdf->Cell(8,8,"$fila[2]",0,0,'C');
		//Foto del conductor
		$pdf->Image('foto.jpg', 5, 30, 40, 40);
		//Folio
		$pdf->SetFont('Arial','B',15);
		$pdf->SetTextColor(239,13,26);
		$pdf->SetXY(45,25);
		$pdf->Cell(33.5,8,"$folio",0,0,'R');
		//Datos Restantes
		$pdf->SetFont('Arial','B',6);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(29,33);
		$pdf->MultiCell(50,3,"Fecha de Nacimiento \n $fila2[2] \n Fecha de Expedicion \n $fila[3] \n Valida hasta \n $fila[4] \n Antiguedad \n $fila2[5]",0,'R');
		//Etiqueta Nombre
		$pdf->SetXY(3,70);
		$pdf->SetFont('Arial','B',6);
		$pdf->Cell(8,8,'Nombre:',0,0,'L');
		//Nombre
		$pdf->SetXY(1,80);
		$pdf->SetFont('Arial','B',15);
		$pdf->MultiCell(50,7,"$fila2[1]",0,'C');
		//Firma
		$pdf->SetXY(20,92);
		$pdf->SetFont('Arial','B',6);
		$pdf->Cell(8,8,'Firma',0,0,'C');
		//PARTE TRASERA
		$pdf->Rect(90,1,80,110);
		//Imagenes
		$pdf->Image('911.jpg', 92, 2, 10, 10);
		$pdf->Image('089.jpg', 159, 4, 10, 5);
		$pdf->Image('scq.jpg', 147, 97, 20, 10);
		$pdf->Image($filename, 92, 90, 20, 20);
		//Datos
		$pdf->SetXY(120,20);
		$pdf->MultiCell(50,3,"Domicilio \n $fila2[4] \n Grupo Sanguineo \n $fila2[8] \n Numero de Emergencias \n $fila2[6] \n Restricciones \n $fila2[9] ",0,'R');
		$pdf->Output('F', 'licencia'.$folio.'.pdf');
		//FIN: Creación de PDF

		echo("Consulta ejecutada </br>");
	} else {
		echo ("Consulta fallida </br>");
	}
	

	cerrar($con);

?>
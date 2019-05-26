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
/*
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
		}*/

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
		
		//Generación PDF
		require('../fpdf/fpdf.php');
		//Obtención de datos
		$sql3 = "Select * from multas WHERE Folio = $folio;";
		$query3 = ejecutarConsulta($con, $sql3);
		$fila = mysqli_fetch_row($query3);

		$sql4 = "Select * from licencias WHERE Folio = $fila[3];";
		$query4 = EjecutarConsulta($con, $sql4);
		$fila2 = mysqli_fetch_row($query4);

		$sql5 = "Select * from conductores WHERE RFC = $fila2[1];";
		$query5 = EjecutarConsulta($con, $sql5);
		$fila3 = mysqli_fetch_row($query5);

		$sql6 = "Select * from vehiculos WHERE idVehiculo = $fila[2];";
		$query6 = EjecutarConsulta($con, $sql6);
		$fila4 = mysqli_fetch_row($query6);
		//Formato de multa
		$pdf = new FPDF();
		$pdf -> AddPage();
		$pdf->SetFont('Arial','',15);
		$pdf->SetFillColor(214, 238, 207);$pdf->Rect(30, 20, 160, 100, 'F');
		$pdf->SetDrawColor(170,100,100);$pdf->Line(30, 95, 105, 95);
		$pdf->SetLineWidth(1.5); $pdf->Line(105, 95, 160, 95); $pdf->Line(160, 95,
		163, 90); $pdf->Line(163, 90, 190, 90); $pdf->SetFillColor(150, 20, 200);
		$pdf->Image('scq.png',40,100,20,17);
		$pdf->SetXY(70,100); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial','B',14);
		$pdf->MultiCell(82,5,'PODER EJECUTIVO DEL ESTADO DE QUERETARO',0,'C',false);
		$pdf->SetXY(73,110); $pdf->SetFont('Arial','',7); $pdf->Cell(75,6,'SECRETARIA DE SEGURIDAD CIUDADANA',0,0,'C'); 
		//Datos
		$pdf->SetFont('Arial','B',10);
		//Folio
		$pdf->SetXY(120,25);
		$pdf->MultiCell(50,3,"Folio: $folio",0,'R');
		//Verificación
		//$pdf->SetXY(6,23);
		//$pdf->MultiCell(50,3,"Verificacion:",0,'R');
		//Datos del contribuyente
		$pdf->SetXY(90,25);
		$pdf->Cell(20 , 3, "Datos del contribuyente", 0, 'C');
		//Nombre
		$pdf->SetXY(10,35);
		$pdf->MultiCell(100,3,"Nombre: $fila3[1]",0,'C');
		//Domicilio
		$pdf->SetXY(19,42);
		$pdf->MultiCell(100,3,"Domicilio: $fila3[4]",0,'C');
		//Placa
		$pdf->SetXY(135,35);
		$pdf->MultiCell(50,3,"Placa: $fila4[3]",0,'C');
		//Línea
		$pdf->Line(30.9, 50, 189.5, 50);
		//Descripción
		$pdf->SetXY(33,55);
		$pdf->MultiCell(200,3,"Descripcion: $fila[8]",0,'J');
		//Línea
		$pdf->Line(30.9, 70, 189.5, 70);
		//Emisor
		$pdf->SetXY(33,75);
		$pdf->MultiCell(150,3,"Emisor: $fila[5]",0,'L');
		//Fecha
		$pdf->SetXY(33,80);
		$pdf->MultiCell(100,3,"Fecha: $fila[6]",0,'L');
		//Motivo
		$pdf->SetXY(33,85);
		$pdf->MultiCell(100,3,"Motivo: $fila[4]",0,'L');
		//Garantía
		$pdf->SetXY(150,75);
		$pdf->MultiCell(100,3,"Garantia: $fila[9]",0,'L');
		//Monto
		$pdf->SetXY(150,83);
		$pdf->MultiCell(100,3,"Monto: $fila[7]",0,'L');
		//Código de Barras
		$pdf->Image($filepath,160,100,0,0,'PNG');


		$pdf->Output();
		//$pdf->Output('F', 'multa'.$folio.'.pdf');
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
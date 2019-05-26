<?php
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
		$query6 = EjecutarConsulta($con, $sql5);
		$fila4 = mysqli_fetch_row($query5);



//Formato de multa
$pdf = new FPDF();
$pdf -> AddPage();
$pdf->SetFont('Arial','',15);
$pdf->SetFillColor(214, 238, 207); $pdf->Rect(30, 20, 160, 100, 'F');
$pdf->SetDrawColor(170,100,100); $pdf->Line(30, 95, 105, 95);
$pdf->SetLineWidth(1.5); $pdf->Line(105, 95, 160, 95); $pdf->Line(160, 95,
163, 90); $pdf->Line(163, 90, 190, 90); $pdf->SetFillColor(150, 20, 200);
;$pdf->Image('scq.png',40,100,20,17);
$pdf->SetXY(70,100); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial','B',14);
$pdf->MultiCell(82,5,'PODER EJECUTIVO DEL ESTADO DE QUERETARO',0,'C',false);
$pdf->SetXY(73,110); $pdf->SetFont('Arial','',7); $pdf->Cell(75,6,'SECRETARIA DE SEGURIDAD CIUDADANA',0,0,'C'); 
//Datos
$pdf->SetFont('Arial','B',10);
//Folio
$pdf->SetXY(120,23);
$pdf->MultiCell(50,3,"Folio: $folio",0,'R');
//Verificación
//$pdf->SetXY(6,23);
//$pdf->MultiCell(50,3,"Verificacion:",0,'R');
//Datos del contribuyente
$pdf->SetXY(83,25);
$pdf->Cell(20 , 3, "Datos del contribuyente", 0, 'C');
//Nombre
$pdf->SetXY(0,35);
$pdf->MultiCell(50,3,"Nombre: $fila3[1]",0,'R');
//Domicilio
$pdf->SetXY(2.5,42);
$pdf->MultiCell(50,3,"Domicilio: $fila3[4]",0,'R');
//Placa
$pdf->SetXY(100,35);
$pdf->MultiCell(50,3,"Placa: $fila4[3]",0,'R');
//Línea
$pdf->Line(30.9, 50, 189.5, 50);
//Descripción
$pdf->SetXY(5,55);
$pdf->MultiCell(50,3,"Descripcion: $fila[8]",0,'R');
//Línea
$pdf->Line(30.9, 70, 189.5, 70);
//Emisor
$pdf->SetXY(0,75);
$pdf->MultiCell(50,3,"Emisor: $fila[5]",0,'R');
//Fecha
$pdf->SetXY(0,80);
$pdf->MultiCell(50,3,"Fecha: $fila[6]",0,'R');
//Motivo
$pdf->SetXY(0,85);
$pdf->MultiCell(50,3,"Motivo: $fila[4]",0,'R');
//Garantía
$pdf->SetXY(150,75);
$pdf->MultiCell(50,3,"Garantia: $fila[9]",0,'R');
//Monto
$pdf->SetXY(150,83);
$pdf->MultiCell(50,3,"Monto: $fila[7]",0,'R');

$pdf->Output('F', 'multa'.$folio.'.pdf');
 


 ?>

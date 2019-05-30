<?php
	include('../acceso/auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Control Vehicular</title>
<link rel="stylesheet" href="../static/css/estilos.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


</head>

<body class="body_AC">
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <a class="navbar-brand" href="../sesion/consultasGenerales.php">CV</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
       aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarNavDropdown">
       <ul class="navbar-nav">
         <li class="nav-item ">
           <a class="nav-link" href="../licencias/Plicencia.php">Licencias <span
               class="sr-only">(current)</span></a>
         </li>
         <li class="nav-item active">
           <a class="nav-link" href="../multas/Pmulta.php">Multas</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="../verificaciones/Pverificacion.php">Verificaciones</a>
         </li>
         <li class="nav-item dropdown ">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">
             Vehiculos
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" href="../vehiculos/Pvehiculo.php">Altas</a>
             <a class="dropdown-item" href="../vehiculos/FEvehiculos.php">Bajas</a>
             <a class="dropdown-item" href="../vehiculos/Uvehiculo.php">Modificaciones</a>
           </div>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">
             Conductores
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" href="../conductores/Pconductor.php">Altas</a>
             <a class="dropdown-item" href="../conductores/Feconductor.php">Bajas</a>
             <a class="dropdown-item" href="../conductores/Uconductor.php">Modificaciones</a>
           </div>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">
             Propietarios
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" href="../propietarios/Ppropietario.php">Altas</a>
             <a class="dropdown-item" href="../propietarios/FEpropietario.php">Bajas</a>
             <a class="dropdown-item" href="../propietarios/Upropietario.php">Modificaciones</a>
           </div>
         </li>
       </ul>
     </div>
		 	<button class="btn btn-outline-primary my-2 my-lg-0" type="submit" style="margin-left: 600px"><a href="../acceso/logout.php">Cerrar Sesión</a></button>
   </nav>
<div class="titulo" style="text-align:center; margin-top:20px">
    <h1>Alta de multa</h1>
</div>
<div class="form_AC">

<?php 

	if(isset($_POST['submit'])){
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
		@ $xml = simplexml_load_file($config['temp'] . 'db.xml');

		if($xml === FALSE){

			//No existe el archivo de base de datos aún.
	
			$xml = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?> <db></db>');
	
			$multas = $xml->addChild('multas');
	
			$multa = $multas->addChild('multa');
			$multa->addChild('folio', $folio);
			$multa->addChild('idVerificacion', $idVerificacion);
			$multa->addChild('idVehiculo', $idVehiculo);
			$multa->addChild('licencia', $licencia);
			$multa->addChild('motivo', $motivo);
			$multa->addChild('emisor', $emisor);
			$multa->addChild('fecha', $fecha);
			$multa->addChild('monto', $monto);
			$multa->addChild('descripcion', $descripcion);
			$multa->addChild('garantia', $garantia);
	
	
			echo $xml->asXML($config['temp'] . 'db.xml');
	
		
		} else if( $xml->multas ){
	
			//Existe el archivo xml y también la sección de multas.
	
			$multa = $xml->multas->addchild('multa');
			$multa->addChild('folio', $folio);
			$multa->addChild('idVerificacion', $idVerificacion);
			$multa->addChild('idVehiculo', $idVehiculo);
			$multa->addChild('licencia', $licencia);
			$multa->addChild('motivo', $motivo);
			$multa->addChild('emisor', $emisor);
			$multa->addChild('fecha', $fecha);
			$multa->addChild('monto', $monto);
			$multa->addChild('descripcion', $descripcion);
			$multa->addChild('garantia', $garantia);		
	
			echo $xml->asXML($config['temp'] . 'db.xml');
		} else {
	
			//Sí existe el archivo xml pero no existe la sección de multas.
	
			$multas = $xml->addChild('multas');
	
			$multa = $multas->addChild('multa');
			$multa->addChild('folio', $folio);
			$multa->addChild('idVerificacion', $idVerificacion);
			$multa->addChild('idVehiculo', $idVehiculo);
			$multa->addChild('licencia', $licencia);
			$multa->addChild('motivo', $motivo);
			$multa->addChild('emisor', $emisor);
			$multa->addChild('fecha', $fecha);
			$multa->addChild('monto', $monto);
			$multa->addChild('descripcion', $descripcion);
			$multa->addChild('garantia', $garantia);
	
			echo $xml->asXML($config['temp'] . 'db.xml');
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


		
		$pdf->Output($config['temp'].'multa'.$folio.'.pdf','F');
		echo("<div class='alert alert-success' role='alert'>Multa agregada</div>");
	} else {
		echo ("<div class='alert alert-danger' role='alert'>Error: no se pudó agregar</div>");
	}

	
	cerrar($con);

	}
?>

	<form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Folio</span>
  		</div>
  		<input type="text" name="folio" id="folio" class="form-control" placeholder="" aria-label="folio" aria-describedby="basic-addon1" disabled>
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Verificacion</span>
  		</div>
  		<input type="text" name="idVerificacion" id="idVerificacion" class="form-control" placeholder="" aria-label="idVerificacion" aria-describedby="basic-addon1" required>
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Vehiculo</span>
  		</div>
  		<input type="text" name="idVehiculo" id="idVehiculo" class="form-control" placeholder="" aria-label="idVehiculo" aria-describedby="basic-addon1" required>
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Licencia</span>
  		</div>
  		<input type="text" name="licencia" id="licencia" class="form-control" placeholder="" aria-label="licencia" aria-describedby="basic-addon1" required>
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Motivo</span>
  		</div>
  		<input type="text" name="motivo" id="motivo" class="form-control" placeholder="" aria-label="motivo" aria-describedby="basic-addon1" required>
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Emisor</span>
  		</div>
  		<input type="text" name="emisor" id="emisor" class="form-control" placeholder="" aria-label="emisor" aria-describedby="basic-addon1" >
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Fecha</span>
  		</div>
  		<input type="date" name="fecha" id="fecha" class="form-control" placeholder="" aria-label="fecha" aria-describedby="basic-addon1" >
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Monto</span>
  		</div>
  		<input type="text" name="monto" id="monto" class="form-control" placeholder="" aria-label="monto" aria-describedby="basic-addon1" >
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Descripción</span>
  		</div>
  		<input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="" aria-label="descripcion" aria-describedby="basic-addon1" >
		</div>
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1">Garantía</span>
  		</div>
  		<input type="text" name="garantia" id="garantia" class="form-control" placeholder="" aria-label="garantia" aria-describedby="basic-addon1" >
		</div>

		<p>
    		<label>
    		<input type="submit" name="submit" value="Agregar" class="btn_form" />
    		</label>
		</p>
	</form>
</div>
</form>
</body>
</html>




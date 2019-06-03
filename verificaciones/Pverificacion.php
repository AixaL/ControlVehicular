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
                    <a class="nav-link" href="../licencias/Plicencia.php">Licencias <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../multas/Pmulta.php">Multas</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../verificaciones/Pverificacion.php">Verificaciones</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Vehiculos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../vehiculos/Pvehiculo.php">Altas</a>
                        <a class="dropdown-item" href="../vehiculos/FEvehiculos.php">Bajas</a>
                        <a class="dropdown-item" href="../vehiculos/Uvehiculo.php">Modificaciones</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Conductores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../conductores/Pconductor.php">Altas</a>
                        <a class="dropdown-item" href="../conductores/Feconductor.php">Bajas</a>
                        <a class="dropdown-item" href="../conductores/Uconductor.php">Modificaciones</a>
                    </div>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
          <h1>Alta de Verificaciones</h1>
    </div>
    <div class="form_AC AL">
<?php 

if(isset($_POST['submit'])){
	
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
	$status = mysqli_affected_rows($con);
	if($status>0){
		$idVerificacion = mysqli_insert_id($con);
		$config = parse_ini_file("../configuracion.ini");
		@ $xml = simplexml_load_file($config['temp'] . 'db.xml');

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
	
			$xml->asXML($config['temp'] . 'db.xml');
	
		
		} else if( $xml->verificaciones ){
	
			//Existe el archivo xml y también la sección de verificaciones.
	
			$verificacion = $xml->verificaciones->addchild('verificacion');
			$verificacion->addChild('idVerificacion', $idVerificacion);
			$verificacion->addChild('vehiculo', $vehiculo);
			$verificacion->addChild('periodo', $periodo);
			$verificacion->addChild('tipo', $tipo);
			$verificacion->addChild('centroVerificador', $centroVerificador);
			$verificacion->addChild('dictamen', $dictamen);	
	
			$xml->asXML($config['temp'] . 'db.xml');
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
			
			$xml->asXML($config['temp'] . 'db.xml');
		}

		//CREACION QR
		require "../phpqrcode/qrlib.php";

		$qrData = "Id verificacion: $idVerificacion Vehiculo: $vehiculo Periodo: $periodo Tipo: $tipo Centro: $centroVerificador Dictamen: $dictamen";
		$filename = $config['temp']."verificaciones/"."QRverificacion" . $idVerificacion . ".png";

		QRCode::png($qrData, $filename, "L");

		//FIN CREACION QR
		//INICIO CREACIÓN PDF

		require "../fpdf181/fpdf.php";
		
		
		$sql = "Select * from vehiculos WHERE idVehiculo = '$vehiculo';";
		$Query = EjecutarConsulta($con, $sql);
		$fila = mysqli_fetch_row($Query);
		$pdfname = "verificacion". $idVerificacion . ".pdf";
		ob_start();
		$pdf = new FPDF('L','mm','A4');
		$pdf -> AddPage();
		$pdf->SetFont('Arial','',15);


		$pdf->SetFillColor(255, 247, 247);
		$pdf->Rect(25, 15, 250, 110, 'F');
		$pdf->Image('sds.png',30,18,35,15);
		$pdf->Image('centro.jpg',68,20,30,13);
		$pdf->SetFillColor(238, 88, 88);
		$pdf->Rect(108, 18, 98, 16, 'F');
		$pdf->SetXY(119,22);
		$pdf->SetFont('Arial','',9);
		$pdf->MultiCell(85,4,"PROGRAMA ESTATAL DE VERIFICACION VEHICULAR \n GOBIERNO DEL ESTADO DE QUERETARO",0,'R',false);

		$pdf->SetXY(30,37);
		$pdf->SetFont('Arial','',8.5);
		$pdf->Cell(110,6,'DATOS DEL VEHICULO',0,0,'L');

		//LINEAS RECTAS
		$pdf->SetDrawColor(155,155,155);
		$pdf->SetLineWidth(0);
		$pdf->Line(30, 53, 200, 53);
		$pdf->Line(30, 68, 200, 68);
		$pdf->Line(30, 83, 200, 83);
		$pdf->Line(110, 90, 170, 90);
		$pdf->Line(110, 120, 170, 120);
		$pdf->Line(110, 90, 110, 120);
		$pdf->Line(170, 90, 170, 120);
		$pdf->Line(122, 90, 122, 120);
		$pdf->Line(135, 90, 135, 120);
		$pdf->Line(110, 98, 170, 98);

		$pdf->Rect(202, 93, 73, 20, 'F');
		$pdf->Rect(202, 115, 73, 5, 'F');

		$pdf->SetXY(245,101);
		$pdf->SetTextColor(255,255,255);
		$pdf->SetFont('Arial','B',35);
		$pdf->Cell(110,6,'DOS',0,0,'L');
		//CODIGO QR
		$pdf->Image($filename,220,40,40,40);

		//TITULOS
		$pdf->SetFont('Arial','',6);
		$pdf->SetTextColor(0,0,0);

		$pdf->SetXY(30,52);
		$pdf->Cell(50,6,'TIPO DE SERVICIO',0,0,'L');
		$pdf->SetXY(68,52);
		$pdf->Cell(50,6,'MARCA',0,0,'L');
		$pdf->SetXY(97,52);
		$pdf->Cell(50,6,'SUBMARCA',0,0,'L');
		$pdf->SetXY(137,52);
		$pdf->Cell(50,6,'ANO/MODELO',0,0,'L');
		$pdf->SetXY(177,52);
		$pdf->Cell(50,6,'PLACAS',0,0,'L');
		$pdf->SetXY(30,67);
		$pdf->Cell(50,6,'NUMERO DE SERIE',0,0,'L');
		$pdf->SetXY(68,67);
		$pdf->Cell(68,6,'CLASE',0,0,'L');
		$pdf->SetXY(97,67);
		$pdf->Cell(97,6,'TIPO DE COMBUSTIBLE',0,0,'L');
		$pdf->SetXY(147,67);
		$pdf->Cell(100,6,'NO. DE IDENTIFICACION VEHICULAR',0,0,'L');
		$pdf->SetXY(30,82);
		$pdf->Cell(50,6,'NO. CILINDROS',0,0,'L');
		$pdf->SetXY(68,82);
		$pdf->Cell(50,6,'TIPO DE CARROCERIA',0,0,'L');
		$pdf->SetXY(112,82);
		$pdf->Cell(50,6,'ENTIDAD FEDERATIVA',0,0,'L');
		$pdf->SetXY(165,82);
		$pdf->Cell(50,6,'MUNICIPIO',0,0,'L');

		$pdf->SetXY(30,95);
		$pdf->Cell(50,6,'NO. DE CENTRO',0,0,'L');
		$pdf->SetXY(30,99);
		$pdf->Cell(50,6,'TIPO',0,0,'L');
		$pdf->SetXY(30,103);
		$pdf->Cell(50,6,'DICTAMEN',0,0,'L');
	
		//CONTENIDO
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY(30,48);
		$pdf->Cell(50,6,"$tipo",0,0,'L');
		$pdf->SetXY(67,48);
		$pdf->Cell(50,6,strtoupper($fila[8]),0,0,'L');
		$pdf->SetXY(96,48);
		$pdf->Cell(50,6,strtoupper($fila[16]),0,0,'L');
		$pdf->SetXY(136,48);
		$pdf->Cell(50,6,$fila[13],0,0,'L');
		$pdf->SetXY(175,48);
		$pdf->Cell(50,6,strtoupper($fila[3]),0,0,'L');
		$pdf->SetXY(30,63);
		$pdf->Cell(50,6,$fila[10],0,0,'L');
		$pdf->SetXY(97,63);
		$pdf->Cell(50,6,$fila[12],0,0,'L');
		$pdf->SetXY(145,63);
		$pdf->Cell(50,6,$fila[2],0,0,'L');
		$pdf->SetXY(30,78);
		$pdf->Cell(50,6,$fila[14],0,0,'L');
		$pdf->SetXY(67,78);
		$pdf->Cell(50,6,$fila[4],0,0,'L');
		$pdf->SetXY(50,95);
		$pdf->Cell(50,6,$centroVerificador,0,0,'L');
		$pdf->SetXY(45,99);
		$pdf->Cell(50,6,$tipo,0,0,'L');
		$pdf->SetXY(45,103);
		$pdf->Cell(50,6,$dictamen,0,0,'L');
		$ruta=$config['temp']."verificaciones/";
		$pdf->Output($ruta.$pdfname, 'F');
		ob_end_flush();
	
		
		echo("<div class='alert alert-success' role='alert'>Verificación agregada</div>");
	} else {
		echo ("<div class='alert alert-danger' role='alert'>Error: no se pudo ejecutar</div>");
	}
	cerrar($con);


}

?>
      <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Id Verificación</span>
            </div>
                <input type="text" name="idVehiculo" id="idVehiculo" class="form-control" placeholder="" aria-label="idVehiculo" aria-describedby="basic-addon1" disabled >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Vehiculo</span>
            </div>
                <input type="text" name="vehiculo" id="vehiculo" class="form-control" placeholder="" aria-label="vehiculo" aria-describedby="basic-addon1" required >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Periodo</span>
            </div>
                <input type="text" name="periodo" id="periodo" class="form-control" placeholder="" aria-label="periodo" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Tipo</span>
            </div>
                <input type="text" name="tipo" id="tipo" class="form-control" placeholder="" aria-label="tipo" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Centro Verificador</span>
            </div>
                <input type="text" name="centroVerificador" id="centroVerificador" class="form-control" placeholder="" aria-label="centroVerificador" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Dictamen</span>
            </div>
                <input type="text" name="dictamen" id="dictamen" class="form-control" placeholder="" aria-label="dictamen" aria-describedby="basic-addon1" >
            </div>
            <p>
                <label>
                    <input type="submit" name="submit" value="Aceptar" class="btn_form" />
                </label>
            </p>
        </form>
    </div>
</body>
</html>


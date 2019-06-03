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
                <li class="nav-item">
                    <a class="nav-link" href="../multas/Pmulta.php">Multas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../verificaciones/Pverificacion.php">Verificaciones</a>
                </li>
                <li class="nav-item dropdown active ">
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
        <h1>Modificar Vehiculo</h1>
    </div>
    <div class="form_AC">
<?php 

$parametros = parse_ini_file("../credenciales.ini");

//------------DB ORIGINAL------------
	$dsnControl = $parametros['dsn'];
	$userControl =$parametros['user'];
	$passControl=$parametros['password'];
//----------DB RESPALDO--------
	$dsnRControl = $parametros['dsn2'];
	$userRControl =$parametros['user2'];
	$passRControl=$parametros['password2'];

	if(isset($_POST['submit'])){
		$idVehiculo = $_POST['idVehiculo'];
		$propietario = $_POST['propietario'];
		$placa = $_POST['placa'];
		// $NIV = $_POST['NIV'];
		// $tipo = $_POST['tipo'];
		$color = $_POST['color'];
		$uso = $_POST['uso'];
		// $numeroPuertas = $_POST['numPuerta'];
		// $marca = $_POST['marca'];
		$numeroMotor = $_POST['numMotor'];
		// $numeroSerie = $_POST['numSerie'];
		// $modelo = $_POST['modelo'];
		$combustible = $_POST['combustible'];
		// $anio = $_POST['anio'];
		$cilindros = $_POST['cilindros'];
		$transmision = $_POST['transmision'];
		// $linea = $_POST['linea'];
        // $origen = $_POST['origen'];
        
		
		include("../conexion.php");
		$con = conectar();
		
		$sql = "UPDATE vehiculos SET Propietario='$propietario',Placa='$placa',Color='$color',Uso='$uso',numMotor='$numeroMotor',Combustible='$combustible',Cilindraje='$cilindros',Transmision='$transmision' WHERE idVehiculo='$idVehiculo';";
		// $sql = "UPDATE vehiculos SET Propietario='$propietario',NIV='$NIV',Placa='$placa',Tipo='$tipo',Color='$color',Uso='$uso',numPuerta='$numeroPuertas',Marca='$marca',numMotor='$numeroMotor',numSerie='$numeroSerie',Modelo='$modelo',Combustible='$combustible',Anio='$anio',Cilindraje='$cilindros',Transmision='$transmision',Linea='$linea',Origen='$origen' WHERE idVehiculo='$idVehiculo';";
        
        $conexionControl= odbc_connect($dsnControl,$userControl,$passControl);
	    $conexionRControl= odbc_connect($dsnRControl,$userRControl,$passRControl);

	    $query=odbc_exec($conexionControl,$sql);
	            odbc_exec($conexionRControl,$sql);

		// $query = ejecutarConsulta($con, $sql);
		if(odbc_num_rows($query)>0){
			
            $config = parse_ini_file("../configuracion.ini");
			@ $xml = simplexml_load_file($config['temp'] . 'db.xml');
			
			$vehiculos = $xml->vehiculos;
			foreach ($vehiculos->vehiculo as $vehiculo) {
				if($vehiculo->idVehiculo == $idVehiculo){
					$vehiculo->propietario = $propietario;
					$vehiculo->placa = $placa;
					// $vehiculo->tipo = $tipo;
					$vehiculo->color = $color;
					$vehiculo->uso = $uso;
					$vehiculo->numeroMotor = $numeroMotor;
					// $vehiculo->addChild('numeroSerie', $numeroSerie);
					$vehiculo->combustible = $combustible;
					$vehiculo->cilindros = $cilindros;
					$vehiculo->transmision = $transmision;
					// $vehiculo->addChild('linea', $linea);
					break;
				}
			}
			$xml->asXML($config['temp']. 'db.xml');

            $sql2 = "Select * from vehiculos WHERE idVehiculo = '$idVehiculo';";
            $Query2 = EjecutarConsulta($con, $sql2);
            $fila2 = mysqli_fetch_row($Query2);

            $NIV = $fila2[2];

            // INICIO: Generación de QR
            require "../phpqrcode/qrlib.php";

            $qrData = "Id: $idVehiculo Propietario: $propietario NIV: $NIV";
            $filename = $config['temp']."vehiculos/"."QRvehiculo" . $idVehiculo . ".png";

            QRCode::png($qrData, $filename, "L");

            // FIN: Generación de QR

            //INICIO Generación de PDF

            require "../fpdf181/fpdf.php";

            $sql = "Select * from propietarios WHERE RFC = '$propietario';";
            $Query = EjecutarConsulta($con, $sql);
            $fila = mysqli_fetch_row($Query);
            $ruta =$config['temp']."vehiculos/";
            $pdfname = $ruta."vehiculo". $idVehiculo . ".pdf";

            $pdf = new FPDF();
            $pdf -> AddPage();
            $pdf->SetFont('Arial','',15);

            $pdf->SetFillColor(247, 255, 212);
            $pdf->Rect(30, 20, 160, 100, 'F');
            $pdf->SetDrawColor(76,176,246);
            $pdf->Line(30, 95, 105, 95);
            $pdf->SetLineWidth(1.5);
            $pdf->Line(105, 95, 160, 95);
            $pdf->Line(160, 95, 163, 90);
            $pdf->Line(163, 90, 190, 90);
            $pdf->SetFillColor(74, 67, 252);
            $pdf->Rect(48, 113, 110, 7 , 'F');
            $pdf->SetXY(48,114);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(110,6,'TARJETA DE CIRCULACION VEHICULAR',0,0,'C');
            $pdf->Image('poder.jpg',65,96,18,15);
            $pdf->Image('qro.png',45,96,18,15);
            $pdf->SetXY(80,97);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',14);
            $pdf->MultiCell(82,5,'PODER EJECUTIVO DEL ESTADO DE QUERETARO',0,'C',false);
            $pdf->SetXY(83,105);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(75,6,'SECRETARIA DE PLANEACION Y FINANZAS',0,0,'C');
            $pdf->Image($filename,163,93,25,25);

            //----------------------------TITULOS LETRA 5.5------------------
            $pdf->SetXY(35,26);
            $pdf->SetFont('Arial','',5.5);
            $pdf->Cell(22,6,'TIPO DE SERVICIO',0,0,'C');

            $pdf->SetXY(35,32);
            $pdf->Cell(19,6,'PROPIETARIO',0,0,'C');

            $pdf->SetXY(75,26);
            $pdf->Cell(22,6,'HOLOGRAMA',0,0,'C');

            $pdf->SetXY(93,26);
            $pdf->Cell(22,6,'FOLIO',0,0,'C');

            $pdf->SetXY(122,26);
            $pdf->Cell(22,6,'VIGENCIA',0,0,'L');

            $pdf->SetXY(150,26);
            $pdf->Cell(22,6,'PLACA',0,0,'L');

            $pdf->SetXY(35,39.5);
            $pdf->Cell(10,6,'RFC',0,0,'C');

            $pdf->SetXY(35,45);
            $pdf->Cell(17,6,'LOCALIDAD',0,0,'C');

            $pdf->SetXY(34,54);
            $pdf->Cell(17,6,'MUNICIPIO',0,0,'C');

            $pdf->SetXY(36.5,65);
            $pdf->MultiCell(38,2.5,'NUMERO DE CONSTANCIA DE INSCRIPCION (NCI)',0,'L',false);

            $pdf->SetXY(34,73);
            $pdf->Cell(15,6,'ORIGEN',0,0,'C');

            $pdf->SetXY(34,79);
            $pdf->Cell(14.5,6,'COLOR',0,0,'C');

            $pdf->SetXY(75,39.5);
            $pdf->Cell(25,6,'NUMERO DE SERIE',0,0,'C');

            $pdf->SetXY(75,46);
            $pdf->Cell(30,6,'MARCA/LINEA/SUBLINEA',0,0,'C');

            $pdf->SetXY(73,63);
            $pdf->Cell(30,6,'CILINDRAJE',0,0,'C');

            $pdf->SetXY(73,66);
            $pdf->Cell(30,6,'CAPACIDAD',0,0,'C');

            $pdf->SetXY(72,69);
            $pdf->Cell(30,6,'PUERTAS',0,0,'C');

            $pdf->SetXY(72,72);
            $pdf->Cell(30,6,'ASIENTOS',0,0,'C');

            $pdf->SetXY(74,75);
            $pdf->Cell(30,6,'COMBUSTIBLE',0,0,'C');

            $pdf->SetXY(74,81);
            $pdf->Cell(30,6,'TRANSMISION',0,0,'C');

            $pdf->SetXY(98,63);
            $pdf->Cell(30,6,'CVE VEHICULAR',0,0,'C');

            $pdf->SetXY(104,68);
            $pdf->Cell(30,6,'CLASE',0,0,'L');

            $pdf->SetXY(104,71);
            $pdf->Cell(30,6,'TIPO',0,0,'L');

            $pdf->SetXY(104,77);
            $pdf->Cell(30,6,'USO',0,0,'L');

            $pdf->SetXY(140,39.5);
            $pdf->Cell(25,6,'MODELO',0,0,'L');

            $pdf->SetXY(140,47);
            $pdf->Cell(25,6,'NUMERO DE MOTOR',0,0,'L');

            //-----------------------CONTENIDOS LETRA 7---------------------

            $pdf->SetFont('Arial','',8);
            //SERVICIO
            $pdf->SetXY(37,29);
            $pdf->Cell(21,6,strtoupper($uso),0,0,'L');
            //PROPIETARIO
            $pdf->SetXY(59,34);
            $pdf->Cell(25,6,strtoupper($fila[1]),0,0,'C');
            //FOLIO
            $pdf->SetXY(93.5,29);
            $pdf->Cell(22,6,$idVehiculo,0,0,'C');
            //VIGENCIA
            $pdf->SetXY(122,29);
            $pdf->Cell(22,6,'INDEFINIDA',0,0,'L');
            //RFC
            $pdf->SetXY(37,42);
            $pdf->Cell(25,6,strtoupper($propietario),0,0,'L');

            /*$ubicacion = explode(',',$fila[2]);
            //LOCALIDAD
            $pdf->SetXY(36.5,49.6);
            $pdf->MultiCell(30,2.5,$ubicacion[1],0,'L',false);
            //MUNICIPIO
            $pdf->SetXY(36,57);
            $pdf->Cell(18,6,$ubicacion[2],0,'L',false);*/
            //NCI
            $pdf->SetXY(36.4,69);
            $pdf->Cell(19,6,$idVehiculo,0,'L',false);
            //ORIGEN
            $pdf->SetXY(37,76);
            $pdf->Cell(20,6,strtoupper($fila2[17]),0,0,'L');
            //COLOR
            $pdf->SetXY(37,82);
            $pdf->Cell(13.5,6,strtoupper($color),0,0,'L');
            //NUM SERIE
            $pdf->SetXY(77,42);
            $pdf->Cell(31,6,$fila2[10],0,0,'L');
            //MARCA
            $pdf->SetXY(77.5,51);
            $pdf->MultiCell(35,2.5,strtoupper($fila2[8]).'/'.strtoupper($fila2[16]).'/BASICO, '.$cilindros.' CIL',0,'L',false);

            //CILINDRAJE
            $pdf->SetXY(96,63);
            $pdf->Cell(30,6,$cilindros,0,0,'L');
            //CAPACIDAD
            $pdf->SetXY(96,66);
            $pdf->Cell(30,6,'0',0,0,'L');
            //PUERTAS
            $pdf->SetXY(96,69);
            $pdf->Cell(30,6,$fila2[7],0,0,'L');
            //ASIENTOS
            $pdf->SetXY(96,72);
            $pdf->Cell(30,6,'5',0,0,'L');
            //COMBUSTIBLE
            $pdf->SetXY(81,78);
            $pdf->Cell(30,6,strtoupper($combustible),0,0,'L');
            //TRANSMISION
            $pdf->SetXY(81,84);
            $pdf->Cell(30,6,strtoupper($transmision),0,0,'L');
            //CVE VEHICULAR
            $pdf->SetXY(104,65.5);
            $pdf->Cell(30,6,$NIV,0,0,'L');
            //CLASE
            $pdf->SetXY(112,68);
            $pdf->Cell(30,6,'1',0,0,'L');
            //TIPO
            $pdf->SetXY(104,73.5);
            $pdf->Cell(30,6,strtoupper($fila2[4]),0,0,'L');
            //USO
            $pdf->SetXY(104,80);
            $pdf->Cell(30,6,strtoupper($uso),0,0,'L');
            //MODELO
            $pdf->SetXY(140,42);
            $pdf->Cell(25,6,strtoupper($fila2[11]),0,0,'L');
            //NUMERO DE MOTOR
            $pdf->SetXY(140,50);
            $pdf->Cell(25,6,$numeroMotor,0,0,'L');

            //---------------PLACA-----------------
            $pdf->SetXY(150,29);
            $pdf->SetFont('Arial','',9);
            $pdf->Cell(22,6,$placa,0,0,'L');

            $ruta =$config['temp']."vehiculos/";
            $pdf->Output($ruta . $pdfname, 'F');
            ob_end_flush();


			
			echo("<div class='alert alert-success' role='alert'>Vehiculo modificado</div>");
		} else {
			echo ("<div class='alert alert-danger' role='alert'>Error: No se pudo ejecutar</div>");
		}
		cerrar($con);
		
	}
	
	
?>
        <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Id Vehiculo</span>
            </div>
                <input type="text" name="idVehiculo" id="idVehiculo" class="form-control" placeholder="" aria-label="idVehiculo" aria-describedby="basic-addon1" required >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Propietario</span>
            </div>
                <input type="text" name="propietario" id="propietario" class="form-control" placeholder="" aria-label="propietario" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Placa</span>
            </div>
                <input type="text" name="placa" id="placa" class="form-control" placeholder="" aria-label="placa" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Color</span>
            </div>
                <input type="text" name="color" id="color" class="form-control" placeholder="" aria-label="color" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Uso</span>
            </div>
                <input type="text" name="uso" id="uso" class="form-control" placeholder="" aria-label="uso" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Número de motor</span>
            </div>
                <input type="text" name="numMotor" id="numMotor" class="form-control" placeholder="" aria-label="numMotor" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Combustible</span>
            </div>
                <input type="text" name="combustible" id="combustible" class="form-control" placeholder="" aria-label="combustible" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Cilindros</span>
            </div>
                <input type="text" name="cilindros" id="cilindros" class="form-control" placeholder="" aria-label="cilindros" aria-describedby="basic-addon1" >
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Transmisión</span>
            </div>
                <input type="text" name="transmision" id="transmision" class="form-control" placeholder="" aria-label="transmision" aria-describedby="basic-addon1" >
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


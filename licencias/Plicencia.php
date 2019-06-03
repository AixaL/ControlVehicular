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
<body class="body_AL">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../sesion/consultasGenerales.php">CV</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link active" href="../licencias/Plicencia.php">Licencias <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
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
    <h1>Alta de Licencia</h1>
  </div>
  <div class="form_AC AL">
<?php 

if(isset($_POST['submit'])){
			// $folio = 1;
	$conductor = $_POST['conductor'];
	$tipoLicencia = $_POST['tipoLicencia'];
	$fechaEmision = $_POST['fechaEmision'];
	$fechaVencimiento = $_POST['fechaVencimiento'];
	// echo($fechaVencimiento);
	$estadoEmision = $_POST['estadoEmision'];

	include("../conexion.php");
	$con = conectar();

	$sql = "INSERT INTO licencias VALUES ('', '$conductor', '$tipoLicencia', '$fechaEmision', '$fechaVencimiento', '$estadoEmision');";

	$query = ejecutarConsulta($con, $sql);
	$status = mysqli_affected_rows($con);
	if($status>0){

		// INICIO: Generación de XML
		$folio = mysqli_insert_id($con);
		$config = parse_ini_file("../configuracion.ini");
		@ $xml = simplexml_load_file($config['temp'] . 'db.xml');
		
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
	
			$xml->asXML($config['temp'] . 'db.xml');
	
		
		} else if( $xml->licencias ){
	
			//Existe el archivo xml y también la sección de licencias.
	
			$licencia = $xml->licencias->addchild('licencia');
	
			$licencia->addChild('conductor', $conductor);
			$licencia->addChild('tipoLicencia', $tipoLicencia);
			$licencia->addChild('fechaEmision', $fechaEmision);
			$licencia->addChild('fechaVencimiento', $fechaVencimiento);
			$licencia->addChild('estadoEmision', $estadoEmision);
	
	
	
			$xml->asXML($config['temp'] . 'db.xml');
		} else {
	
			//Sí existe el archivo xml pero no existe la sección de licencias.
	
			$licencias = $xml->addChild('licencias');
			$licencia = $licencias->addChild('licencia');
			$licencia->addChild('conductor', $conductor);
			$licencia->addChild('tipoLicencia', $tipoLicencia);
			$licencia->addChild('fechaEmision', $fechaEmision);
			$licencia->addChild('fechaVencimiento', $fechaVencimiento);
			$licencia->addChild('estadoEmision', $estadoEmision);
	
			$xml->asXML($config['temp'] . 'db.xml');
		}
		// FIN: Generación de XML
		// INICIO: Generación de QR
		require "../phpqrcode/qrlib.php";

		$qrData = "Folio: $folio Conductor: $conductor Vigencia: $fechaVencimiento";
		$filename = $config['temp']."licencias/"."licencia" . $folio . ".png";

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

		require('../fpdf/fpdf.php');
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
		$ruta=$config['temp']."licencias/";
		$pdf->Output($ruta. 'licencia'.$folio.'.pdf','F');
		//FIN: Creación de PDF

		echo("<div class='alert alert-success' role='alert'>Licencia agregada</div>");
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
    	<span class="input-group-text" id="basic-addon1">Conductor</span>
  	</div>
  	<input type="text" name="conductor" id="conductor" class="form-control" placeholder="" aria-label="conductor" aria-describedby="basic-addon1" required>
	</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Tipo de licencia</span>
  	</div>
  	<input type="text" name="tipoLicencia" id="tipoLicencia" class="form-control" placeholder="" aria-label="tipoLicencia" aria-describedby="basic-addon1" >
	</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Fecha de emisión</span>
  	</div>
  	<input type="date" name="fechaEmision" id="fechaEmision" class="form-control" placeholder="" aria-label="fechaEmision" aria-describedby="basic-addon1" required>
	</div>
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="fechaVencimiento">Fecha de vencimiento</label>
  </div>
  <select class="custom-select" id="fechaVencimiento" name="fechaVencimiento">
    <option selected>Fecha de vencimiento</option>
    <option value="1" id="tres">3 años</option>
    <option value="2" id="cinco">5 años</option>
  </select>
</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Estado de emisión</span>
  	</div>
  	<input type="text" name="estadoEmision" id="estadoEmision" class="form-control" placeholder="" aria-label="estadoEmision" aria-describedby="basic-addon1" required>
	</div>
	<!-- <div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Foto</span>
  	</div>
  	<input type="file" name="foto" id="foto" class="form-control" placeholder="" aria-label="foto" aria-describedby="basic-addon1" required>
	</div> -->
	<p>
    <label>
    <input type="submit" name="submit" value="Agregar" class="btn_form" />
    </label>
	</p>
</form>
</div>
<script>
window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var fecha2 = new Date(); //Fecha actual
  var fecha3 = new Date(); //Fecha actual
	// var fecha2.setFullYear(fecha2.getFullYear()+3);
	// var fecha3.setFullYear(fecha3.getFullYear()+5);
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  var ano1 = fecha.getFullYear()+3; //obteniendo año
  var ano2 = fecha.getFullYear()+5; //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('fechaEmision').value=ano+"-"+mes+"-"+dia;

  document.getElementById('tres').value=ano1+"-"+mes+"-"+dia;
  document.getElementById('cinco').value=ano2+"-"+mes+"-"+dia;
var fec1=dia+"/"+mes+"/"+ano1;
var fec2=dia+"/"+mes+"/"+ano2;
// var fec2=ano2+"-"+mes+"-"+dia;

  document.getElementById('tres').innerHTML=fec1;
  document.getElementById('cinco').innerHTML=fec2;


	console.log(fecha2.getFullYear()+3);
	console.log(fecha2.getFullYear()+5);
	console.log(fecha3);
}

</script>
</body>
</html>


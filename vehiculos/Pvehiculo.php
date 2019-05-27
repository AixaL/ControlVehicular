<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <li class="nav-item">
          <a class="nav-link" href="../verificaciones/Pverificacion.php">Verificaciones</a>
        </li>
        <li class="nav-item dropdown active ">
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
  </nav>


<div class="titulo" style="text-align:center; margin-top:20px">
  <h1>Alta de Vehiculo</h1>
</div>
<div class="form_AC AV ">

<?php 

	// AUTENTIFICACIÓN
	include('../acceso/auth.php');
	if(isset($_POST['submit'])){
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
}

	
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

  <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Id Vehiculo</span>
    </div>
      <input type="text" name="idVehiculo" id="idVehiculo" class="form-control" placeholder="" aria-label="idVehiculo" aria-describedby="basic-addon1" disabled>
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Propietario</span>
    </div>
      <input type="text" name="propietario" id="propietario" class="form-control" placeholder="" aria-label="propietario" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">NIV</span>
    </div>
      <input type="text" name="NIV" id="NIV" class="form-control" placeholder="" aria-label="NIV" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Placa</span>
    </div>
      <input type="text" name="placa" id="placa" class="form-control" placeholder="" aria-label="placa" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Tipo</span>
    </div>
      <input type="text" name="tipo" id="tipo" class="form-control" placeholder="" aria-label="tipo" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Color</span>
    </div>
      <input type="text" name="color" id="color" class="form-control" placeholder="" aria-label="color" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Uso</span>
    </div>
      <input type="text" name="uso" id="uso" class="form-control" placeholder="" aria-label="uso" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Número de puertas </span>
    </div>
      <input type="number" name="numPuerta" id="numPuerta" class="form-control" placeholder="" aria-label="numPuerta" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Marca</span>
    </div>
      <input type="text" name="marca" id="marca" class="form-control" placeholder="" aria-label="marca" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Número de motor</span>
    </div>
      <input type="text" name="numMotor" id="numMotor" class="form-control" placeholder="" aria-label="numMotor" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Número de serie</span>
    </div>
      <input type="text" name="numSerie" id="numSerie" class="form-control" placeholder="" aria-label="numSerie" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Modelo</span>
    </div>
      <input type="text" name="modelo" id="modelo" class="form-control" placeholder="" aria-label="modelo" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Combustible</span>
    </div>
      <input type="text" name="combustible" id="combustible" class="form-control" placeholder="" aria-label="combustible" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Año</span>
    </div>
      <input type="text" name="anio" id="anio" class="form-control" placeholder="" aria-label="anio" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Cilindros</span>
    </div>
      <input type="text" name="cilindros" id="cilindros" class="form-control" placeholder="" aria-label="cilindros" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Transmisión</span>
    </div>
      <input type="text" name="transmision" id="transmision" class="form-control" placeholder="" aria-label="transmision" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Linea</span>
    </div>
      <input type="text" name="linea" id="linea" class="form-control" placeholder="" aria-label="linea" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Origen</span>
    </div>
      <input type="text" name="origen" id="origen" class="form-control" placeholder="" aria-label="origen" aria-describedby="basic-addon1">
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

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
<body class="body_AC" >
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
			<!-- <button type="button" class="btn btn-primary" style="float:right">Cerrar Sesión</button> -->
			<button class="btn btn-outline-primary my-2 my-lg-0" type="submit" style="margin-left: 600px"><a href="../acceso/logout.php">Cerrar Sesión</a></button>
    </div>
  </nav>
<div class="titulo" style="text-align:center; margin-top:20px">
    <h1>Alta de Conductor</h1>
  </div>
  <div class="form_AC AC">
	<form id="form1" name="form1" method="post" action="#" enctype="multipart/form-data">
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">RFC</span>
  	</div>
  	<input type="text" name="RFC" id="RFC" class="form-control" placeholder="..." aria-label="RFC" aria-describedby="basic-addon1" required>
	</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Nombre</span>
  	</div>
  	<input type="text" name="nombre" id="nombre" class="form-control" placeholder=" " aria-label="nombre" aria-describedby="basic-addon1" required>
	</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Fecha de nacimiento</span>
  	</div>
  	<input type="date" name="fechaNacimiento" class="form-control" id="fechaNacimiento" aria-label="nombre" aria-describedby="basic-addon1" required>
	</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Domicilio</span>
  	</div>
  	<input type="text" name="domicilio" class="form-control" id="domicilio" aria-label="domicilio" aria-describedby="basic-addon1">
	</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Antiguedad</span>
  	</div>
  	<input type="text" name="antiguedad" class="form-control" id="antiguedad" aria-label="antiguedad" aria-describedby="basic-addon1">
	</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Antiguedad</span>
  	</div>
  	<input type="text" name="antiguedad" class="form-control" id="antiguedad" aria-label="antiguedad" aria-describedby="basic-addon1">
	</div>
	<!-- <label>Sexo</label> -->
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    <div class="input-group-text">
      <input type="radio" aria-label="Checkbox for following text input"  name="sexo" value="hombre" id="sexo">
    </div>
  	</div>
  	<input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Hombre" disabled>
	</div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    <div class="input-group-text">
      <input type="radio" aria-label="Checkbox for following text input" name="sexo" value="mujer" id="sexo">
    </div>
  	</div>
  		<input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Mujer" disabled> 
	</div>
  	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Tipo de Sangre</span>
  	</div>
  	<input type="text" name="tipoSangre" class="form-control" id="tipoSangre" aria-label="tipoSangre" aria-describedby="basic-addon1">
	</div>
  	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Restricciones</span>
  	</div>
  	<input type="text" name="restricciones" class="form-control" id="restricciones" aria-label="restricciones" aria-describedby="basic-addon1">
	</div>
  	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Telefono de emergencia</span>
  	</div>
  	<input type="text" name="telEmergencia" class="form-control" id="telEmergencia" aria-label="telEmergencia" aria-describedby="basic-addon1">
	</div>
  	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Firma</span>
  	</div>
  	<input type="file" name="firma" class="form-control" id="firma" aria-label="firma" aria-describedby="basic-addon1">
	</div>
  	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Foto</span>
  	</div>
  	<input type="file" name="foto" class="form-control" id="foto" aria-label="foto" aria-describedby="basic-addon1">
	</div>
  <p>
    <label>
    <input type="submit" name="submit" value="Agregar" class="btn_form" />
    </label>
</p>
</form>
</div>




<?php 

if(isset($_POST['submit'] ) && $_SERVER["REQUEST_METHOD"] == "POST"){
	$RFC = $_POST['RFC'];
	$nombre = $_POST['nombre'];
	$fechaNacimiento = $_POST['fechaNacimiento'];
	$firma = "";
	$domicilio = $_POST['domicilio'];
	$antiguedad = $_POST['antiguedad'];
	$sexo = $_POST['sexo'];
	$tipoSangre = $_POST['tipoSangre'];
	$restricciones = $_POST['restricciones'];
	$telEmergencia = $_POST['telEmergencia'];

	include("../conexion.php");
	$con = conectar();

	$sql = "INSERT INTO conductores VALUES ('$RFC', '$nombre', '$fechaNacimiento', '$firma', '$domicilio', '$antiguedad', '$telEmergencia', '$sexo', '$tipoSangre', '$restricciones');";
	$query = ejecutarConsulta($con, $sql);

	if($query){

		$config = parse_ini_file("../configuracion.ini");
		@ $xml = simplexml_load_file($config['temp'] . 'db.xml');

		if($xml === FALSE){

			//No existe el archivo de base de datos aún.

			$xml = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?> <licencias></licencias>');

			$conductores = $xml->addChild('conductores');

			$conductor = $conductores->addChild('conductor');
			$conductor->addChild('RFC', $RFC);
			$conductor->addChild('nombre', $nombre);
			$conductor->addChild('fechaNacimiento', $fechaNacimiento);
			$conductor->addChild('firma', $firma);
			$conductor->addChild('domicilio', $domicilio);
			$conductor->addChild('antiguedad', $antiguedad);
			$conductor->addChild('sexo', $sexo);
			$conductor->addChild('tipoSangre', $tipoSangre);
			$conductor->addChild('restricciones', $restricciones);
			$conductor->addChild('telEmergencia', $telEmergencia);

			$xml->asXML($config['temp'] . 'db.xml');

		
		} else if( $xml->conductores ){

			//Existe el archivo xml y también la sección de conductores.

			$conductor = $xml->conductores->addchild('conductor');

			$conductor->addChild('RFC', $RFC);
			$conductor->addChild('nombre', $nombre);
			$conductor->addChild('fechaNacimiento', $fechaNacimiento);
			$conductor->addChild('firma', $firma);
			$conductor->addChild('domicilio', $domicilio);
			$conductor->addChild('antiguedad', $antiguedad);
			$conductor->addChild('sexo', $sexo);
			$conductor->addChild('tipoSangre', $tipoSangre);
			$conductor->addChild('restricciones', $restricciones);
			$conductor->addChild('telEmergencia', $telEmergencia);

			$xml->asXML($config['temp'] . 'db.xml');
		} else {

		
			$conductores = $xml->addChild('conductores');

			$conductor = $conductores->addChild('conductor');
			$conductor->addChild('RFC', $RFC);
			$conductor->addChild('nombre', $nombre);
			$conductor->addChild('fechaNacimiento', $fechaNacimiento);
			$conductor->addChild('firma', $firma);
			$conductor->addChild('domicilio', $domicilio);
			$conductor->addChild('antiguedad', $antiguedad);
			$conductor->addChild('sexo', $sexo);
			$conductor->addChild('tipoSangre', $tipoSangre);
			$conductor->addChild('restricciones', $restricciones);
			$conductor->addChild('telEmergencia', $telEmergencia);

			$xml->asXML($config['temp'] . 'db.xml');
		}
		echo("<div class='alert alert-success' role='alert'>Conductor agregado</div>");
	} else {
		echo ("<div class='alert alert-success' role='alert'>Error: no se pudó agregar</div>");
	}
		
	cerrar($con);
	
}

	
	

?>
</body>
</html>
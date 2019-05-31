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
		if($query){
			
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
			
			$xml->asXML($config['temp'] . 'db.xml');
			
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


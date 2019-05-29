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
                <li class="nav-item dropdown">
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
        <h1>Baja de Vehiculo</h1>
    </div>
    <div class="form_BC ">
<?php 

    if(isset($_POST['key'])){
        $key = $_POST['key'];
        // echo($key);

        include("../conexion.php");
        $con = conectar();

        $sql = "DELETE FROM vehiculos WHERE idVehiculo = '$key';";
        ejecutarConsulta($con, $sql);
        
        $status = mysqli_affected_rows($con);
        // $error = mysqli_error($con);
        // echo($error);

	    if($status == -1){
            //Consulta fallida, ocurrió un error.
		    echo("<div class='alert alert-danger' role='alert'>Error: No se pudo ejecutar</div>");
        } else if($status == 0) {
            //Consulta exitosa, registro no encontrado, cero filas afectadas.
	    	echo ("<div class='alert alert-danger' role='alert'>Error: Ningun vehiculo eliminado</div>");
    	} else if($status > 0){
            //Consulta exitosa, registro encontrado.
            $config = parse_ini_file("../configuracion.ini");
            @ $xml = simplexml_load_file($config['temp'] . 'db.xml');
            
            $vehiculos = $xml->vehiculos;
            foreach ($vehiculos->vehiculo as $vehiculo) {
                if($vehiculo->idVehiculo == $key){
                    $dom=dom_import_simplexml($vehiculo);
                    $dom->parentNode->removeChild($dom);
                    break;
                }
            }
    
            echo $xml->asXML($config['temp'] . 'db.xml');
            echo("<div class='alert alert-success' role='alert'>Vehiculo eliminado</div>");
        }
        cerrar($con);

    }
?>
    <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Id Vehiculo</span>
            </div>
            <input type="text" name="key" id="key" class="form-control" placeholder="" aria-label="key" aria-describedby="basic-addon1" required>
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

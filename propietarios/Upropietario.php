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
                <li class="nav-item dropdown ">
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
                <li class="nav-item dropdown active">
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
        <h1>Modificar Propietario</h1>
    </div>
    <div class="form_BC AP">
		<?php 

	if(isset($_POST['submit'])){
	$RFC = $_POST['RFC'];
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];

	include("../conexion.php");
	$con = conectar();

	// $sql = "INSERT INTO propietarios VALUES ('$RFC', '$nombre', '$direccion', '$telefono', '$correo');";
	$sql = "UPDATE propietarios SET Nombre='$nombre', Direccion='$direccion', Telefono='$telefono', Correo='$correo' WHERE RFC='$RFC';";

	$query = ejecutarConsulta($con, $sql);
	$status = mysqli_affected_rows($con);
	if($status != -1){
		echo("<div class='alert alert-success' role='alert'>Propietario Modificado</div>");
	} else {
		echo ("<div class='alert alert-danger' role='alert'>Error: No se pudo ejecutar el cambio</div>");
	}
	cerrar($con);
}
	
?>
    <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">RFC</span>
            </div>
            <input type="text" name="RFC" id="RFC" class="form-control" placeholder="" aria-label="RFC" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Nombre</span>
            </div>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-label="nombre" aria-describedby="basic-addon1" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Dirección</span>
            </div>
            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="" aria-label="direccion" aria-describedby="basic-addon1" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Teléfono</span>
            </div>
            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="" aria-label="telefono" aria-describedby="basic-addon1" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Correo</span>
            </div>
            <input type="email" name="correo" id="correo" class="form-control" placeholder="" aria-label="correo" aria-describedby="basic-addon1" >
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


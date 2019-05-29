<?php
  // include("../conexion.php");
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
    <a class="navbar-brand active" href="../sesion/consultasGenerales.php">CV</a>
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
    <h1>Consultas</h1>
  </div>
  <div class="form_BC">
    <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Seleccionar de:</label>
    </div>
    <select class="custom-select" id="table" name="table">
        <option value="licencias">Licencias</option>
        <option value="multas">Multas</option>
        <option value="vehiculos">Vehiculos</option>
        <option value="conductores">Conductores</option>
        <option value="propietarios">Propietarios</option>
    </select>
    </div>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Donde:</label>
    </div>
    <select class="custom-select" id="conditional" name="conditional">
        <option value="RFC">RFC</option>
        <option value="Nombre">Nombre</option>
        <option value="Folio">Folio</option>
        <option value="Conductor">Conductor</option>
        <option value="idVehiculo">Id Vehiculo</option>
        <option value="Placa">Placa</option>
        <option value="NIV">NIV</option>
        <option value="idVerificacion">Id Verificacion</option>
        <option value="Vehiculo">Vehiculo</option>
        <option value="Propietario">Propietario</option>
    </select>
    </div>
	<div class="input-group mb-3">
  	<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Sea:</span>
  	</div>
  	<input type="text" name="param" id="param" class="form-control" placeholder="..." aria-label="param" aria-describedby="basic-addon1" required>
	</div>
  <p>
    <label>
    <input type="submit" name="submit" value="Aceptar" class="btn_form" />
    </label>
</p>
</form>
</div>
<div class="table-responsive">
  <table class="table">
  <thead class="thead-dark">
  <?php

// include("conexion.php");
include("../conexion.php");
$con = conectar();
if(isset($_POST['submit'])){
  if($_POST['table'] != null && $_POST['conditional'] != null && $_POST['param'] != null){
    $table = $_POST['table'];
    // echo($table);
    $conditional = $_POST['conditional'];
    // echo($conditional);
    $param = $_POST['param'];
    // echo($param);
    $sql = "SELECT * FROM $table WHERE $conditional = $param";
} else if($_POST['table']) {
    $table = $_POST['table'];
    $sql = "SELECT * FROM $table";
} else {
    echo("<div class='alert alert-danger' role='alert'>No fueron enviados parametros</div>");
}

$query = ejecutarConsulta($con, $sql);

$status = mysqli_affected_rows($con);
if($status == -1){
    echo("<div class='alert alert-danger' role='alert'>No se pudo relizar la consulta</div>");
} else if($status == 0) {
    echo ("<div class='alert alert-dark' role='alert'>No se encontraron resultados</div>");
} else if($status > 0){
    echo($status . " resultados encontrados </br>");
    $results = [];
    print(" <tr>");
    while($fila = mysqli_fetch_assoc($query)){
        // $tama= sizeof($fila);
        // print_r($fila);
        // echo($tama);
      foreach ($fila as $key => $value) {
        array_push($results,$value);
        // print($key);
        print("<th scope='col'>$key</th>");
      }
    }
    print("</tr></thead>");
    print("<tbody>");
    print("<tr>");
    foreach ($results as $key => $value) {
      // print($value);
      print("<td>$value</td>");
    }
    print("</tr></tbody>");
    // print_r($results);
    // $tama= sizeof($results);
    // echo($tama);
    // print_r($results);
}


cerrar($con);

}


?>
</table>
</div>
</body>
</html>



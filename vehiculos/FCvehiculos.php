<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Control Vehicular</title>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">CV</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="../licencias/Flicencia.html">Licencias <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../multas/Fmulta.html">Multas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../verificaciones/Fverificacion.html">Verificaciones</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Vehiculos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="../vehiculos/Fvehiculo.html">Altas</a>
          <a class="dropdown-item" href="../vehiculos/FEvehiculos.html">Bajas</a>
          <a class="dropdown-item" href="../vehiculos/Uvehiculo.html">Modificaciones</a>
          <a class="dropdown-item" href="../vehiculos/FCvehiculos.php">Consulta</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Conductores
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Altas</a>
          <a class="dropdown-item" href="#">Bajas</a>
          <a class="dropdown-item" href="#">Modificaciones</a>
          <a class="dropdown-item" href="#">Consulta</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Propietarios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Altas</a>
          <a class="dropdown-item" href="#">Bajas</a>
          <a class="dropdown-item" href="#">Modificaciones</a>
          <a class="dropdown-item" href="#">Consulta</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="title">
  <h1>Consulta Vehiculos</h1>
</div>

<form id="form1" name="form1" method="post" action="#">

  <p>
    <label>Criterio:
    <input name="criterio" type="text" id="criterio" required/>
    </label>
  </p>
  <p>
    <label>
  <select class="browser-default" name="seleccion">
    <option value="" disabled selected>Elige el Criterio</option>
    <option value="idVehiculo">Id Vehiculo </option>
    <option value="Propietario">Propietario</option>
    <option value="NIV">NIV</option>
    <option value="Placa">Placa</option>
  </select>
    <input type="submit" name="submit" value="Enviar" />
    </label>
  </p>
</form>
</body>
</html>


<?php

	if(isset($_POST['submit'])){

    $criterio = $_POST['criterio'];
    $seleccion = $_POST['seleccion'];
		include("../conexion.php");
		$con = conectar();
		$sql = "SELECT * FROM vehiculos WHERE $seleccion LIKE BINARY $criterio;";
		$query = ejecutarConsulta($con, $sql);

		$status = mysqli_affected_rows($con);
	    if($status == -1){
		    echo("Consulta fallida \n");
    	} else if($status == 0) {
	    	echo ("Sin resultados \n");
    	} else if($status > 0){
				echo($status . " resultados encontrados </br>");
				

?>
    <table>
<?php
  while($fila = mysqli_fetch_row($query)){
?>
      <tr>
        <td><?=$fila[0]?></td>
        <td><?=$fila[1]?></td>
        <td><?=$fila[2]?></td>
        <td><?=$fila[3]?></td>
        <td><?=$fila[4]?></td>
      </tr>
<?php
  }
?>
    </table>
<?php

      }
		
		
		cerrar($con);
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="#">

  <p>
    <label>Criterio:
    <input name="criterio" type="text" id="criterio" required/>
    </label>
  </p>

	<select name="seleccion">
    <option value="Folio" selected>Folio Multa</option>
    <option value="idVerificacion">Folio Verificacion</option>
    <option value="Fecha">Fecha</option>
  </select>

  <p>
    <label>
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
		$sql = "SELECT * FROM multas WHERE $seleccion LIKE BINARY '$criterio';";
		$query = ejecutarConsulta($con, $sql);

		$status = mysqli_affected_rows($con);
	    if($status == -1){
		    echo("Consulta fallida \n");
    	} else if($status == 0) {
	    	echo ("Sin resultados \n");
    	} else if($status > 0){
				echo($status . " resultados encontrados </br>");
?>
	<table border="1">
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
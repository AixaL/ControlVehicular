<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../static/css/estilos.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>
<body >
<div class="derecha">
	<div class="titulo">
		<h1>Control Vehicular</h1>
	</div>
	<div class="form">
		<?php 


if(isset($_POST['username']) && isset($_POST['password'])){

session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];
	$llave = $_FILES['key'];
	$directorio = $llave['tmp_name'];
	if($directorio){
		$key = "";
		$manejador = fopen($directorio, "r");
		$string = fgets($manejador);
	} else {
		$string = "";
	}

	include('../conexion.php');

	$con = conectar();
	$sql = "SELECT * FROM usuarios WHERE username = '$username';";
	$result = ejecutarConsulta($con, $sql);

	$n = mysqli_num_rows($result);

	$fila = mysqli_fetch_row($result);
	if($fila[4] == 0){
		if($n == 0){
			print("<div class='alert alert-danger' role='alert'>El usuario ingresado no existe</div>");
		} else {
			if($password == $fila[1] && $string == $fila[2]){
					print("Bem vindo " . $fila[0]);

					$_SESSION['username'] = $username;

					header("location:../sesion/consultasGenerales.php");

			} else {
				print("<div class='alert alert-danger' role='alert'>Contraseña equivocada</div>");

				if($fila[4] == 2){
					$sql = "UPDATE usuarios SET intento = 3 WHERE username = '$username';";
					ejecutarConsulta($con, $sql);
					$sql = "UPDATE usuarios SET estado = 0 WHERE username = '$username';";
					ejecutarConsulta($con, $sql);
				} else {
					$intentos = $fila[4] + 1;
					$sql = "UPDATE usuarios SET intento = $intentos WHERE username = '$username';";
				}
				ejecutarConsulta($con, $sql);
			}
		}
	} else {
		// print("<p>Acceso denegado, contacte a un administrador.</p>");
		print("<div class='alert alert-danger' role='alert'>Acceso denegado, contacte a un administrador.</div>");
	}
	cerrar($con);
} else {
	// echo("Missing arguments username or password");
	echo("<div class='alert alert-warning' role='alert'>Ingresa el campo faltante</div>");
}

	
?>
		<form id="form1" name="form1" method="post" action="#" enctype="multipart/form-data" >
  			<div class="form-group">
    			<label for="user">Usuario</label>
    			<input type="text" class="form-control" id="username" name="username"  placeholder="Ingresa tu usuario" require>
  			</div>
  			<div class="form-group">
    			<label for="pass">Password</label>
    			<input type="password" class="form-control" id="password" name="password" placeholder="Password" require>
  			</div>
  			<div class="form-group">
    			<label for="key">Key</label>
    			<input type="file" class="form-control" id="key" name="key" placeholder="key" require>
  			</div>
  			<button type="submit" class="btn btn-primary">Entrar</button>
		</form>
	</div>
</div>
<div class="izquierda">
	<img src="../static/img/login.png" alt="">
</div>
</body>
</html>


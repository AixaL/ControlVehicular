<?php 

session_start();

if($_POST['username'] != null && $_POST['password'] != null){


	$username = $_POST['username'];
	$password = $_POST['password'];

	include('../conexion.php');

	$con = conectar();
	$sql = "SELECT * FROM usuarios WHERE username = '$username';";
	$result = ejecutarConsulta($con, $sql);

	$n = mysqli_num_rows($result);

	$fila = mysqli_fetch_row($result);
	if($fila[3] != 0){
		if($n == 0){
			print("El usuario ingresado no existe.");
		} else {
			if($password == $fila[1]){
					print("Bem vindo " . $fila[2]);

					$_SESSION['username'] = $username;

					header("location:../sesion/menu.php");

			} else {
				print("La contrasena está equivocada.");

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
		print("Acceso denegado, contacte a un administrador.");
	}

		

	cerrar($con);


} else {
	echo("Missing arguments username or password");
}

	
?>
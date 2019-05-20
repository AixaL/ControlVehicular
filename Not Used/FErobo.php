<html>
    <form action="#" method="POST" name="form1">
        <label>ID Reporte</label>
        <input type="text" placeholder="idReporte" name="key"></input>
        <input type="Submit" name="eliminar"></input>
    </form>
</html>

<?php 
    if(isset($_POST['key'])){
        $key = $_POST['key'];
        print($key);
        include("../conexion.php");
        $con = conectar();
        $sql = "DELETE FROM robos WHERE idReporte = '$key';";
        ejecutarConsulta($con, $sql);
        $status = mysqli_affected_rows($con);
	    if($status == -1){
		    echo("Consulta fallida \n");
    	} else if($status == 0) {
	    	echo ("Cero filas afectadas \n");
    	} else if($status > 0){
            echo($status . " filas afectadas");
        }
        cerrar($con);

    }
?>
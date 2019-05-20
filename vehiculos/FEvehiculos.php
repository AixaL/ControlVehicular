

<?php 
    // AUTENTIFICACIÓN
	include('../acceso/auth.php');

    if(isset($_POST['key'])){
        $key = $_POST['key'];
        echo($key);

        include("../conexion.php");
        $con = conectar();

        $sql = "DELETE FROM vehiculos WHERE idVehiculo = '$key';";
        ejecutarConsulta($con, $sql);
        
        $status = mysqli_affected_rows($con);
        $error = mysqli_error($con);
        echo($error);

	    if($status == -1){
            //Consulta fallida, ocurrió un error.
		    echo("Consulta fallida \n");
        } else if($status == 0) {
            //Consulta exitosa, registro no encontrado, cero filas afectadas.
	    	echo ("Cero filas afectadas \n");
    	} else if($status > 0){
            //Consulta exitosa, registro encontrado.
            $config = parse_ini_file("../configuracion.ini");
            $xml = simplexml_load_file($config['temp']);
            
            $vehiculos = $xml->vehiculos;
            foreach ($vehiculos->vehiculo as $vehiculo) {
                if($vehiculo->idVehiculo == $key){
                    $dom=dom_import_simplexml($vehiculo);
                    $dom->parentNode->removeChild($dom);
                    break;
                }
            }
    
            echo $xml->asXML('../db.xml');
            echo($status . " filas afectadas");
        }
        cerrar($con);

    }
?>
<?php 
    // AUTENTIFICACIÓN
	include('../acceso/auth.php');

    if(isset($_POST['key'])){
        $key = $_POST['key'];
        print($key);
        include("../conexion.php");
        $con = conectar();
        $sql = "DELETE FROM verificaciones WHERE idVerificacion = '$key';";
        ejecutarConsulta($con, $sql);
        $status = mysqli_affected_rows($con);
	    if($status == -1){
		    echo("Consulta fallida \n");
    	} else if($status == 0) {
	    	echo ("Cero filas afectadas \n");
    	} else if($status > 0){
            //Consulta exitosa, registro encontrado.
            $xml = simplexml_load_file('../db.xml');
            
            $verificaciones = $xml->verificaciones;
            $eliminable = null;
            foreach ($verificaciones->verificacion as $verificacion) {
                if($verificacion->idVerificacion == $key){
                    $dom=dom_import_simplexml($verificacion);
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
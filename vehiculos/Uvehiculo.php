<?php 

// AUTENTIFICACIÓN
include('../acceso/auth.php');

// $idVehiculo = $_POST['idVehiculo'];
$propietario = $_POST['propietario'];
$placa = $_POST['placa'];
// $NIV = $_POST['NIV'];
// $tipo = $_POST['tipo'];
$color = $_POST['color'];
$uso = $_POST['uso'];
// $numeroPuertas = $_POST['numPuerta'];
// $marca = $_POST['marca'];
$numeroMotor = $_POST['numMotor'];
// $numeroSerie = $_POST['numSerie'];
// $modelo = $_POST['modelo'];
$combustible = $_POST['combustible'];
// $anio = $_POST['anio'];
$cilindros = $_POST['cilindros'];
$transmision = $_POST['transmision'];
// $linea = $_POST['linea'];
// $origen = $_POST['origen'];

include("../conexion.php");
$con = conectar();

$sql = "UPDATE vehiculos SET Propietario='$propietario',NIV='$NIV',Placa='$placa',Tipo='$tipo',Color='$color',Uso='$uso',numPuerta='$numeroPuertas',Marca='$marca',numMotor='$numeroMotor',numSerie='$numeroSerie',Modelo='$modelo',Combustible='$combustible',Anio='$anio',Cilindraje='$cilindros',Transmision='$transmision',Linea='$linea',Origen='$origen' WHERE idVehiculo='$idVehiculo';";

$query = ejecutarConsulta($con, $sql);
if($query){

	$config = parse_ini_file("../configuracion.ini");
    $xml = simplexml_load_file($config['temp']);

    $vehiculos = $xml->vehiculos;
    foreach ($vehiculos->vehiculo as $vehiculo) {
        if($vehiculo->idVehiculo == $key){
			$vehiculo->propietario = $propietario;
			$vehiculo->placa = $placa;
			// $vehiculo->tipo = $tipo;
			$vehiculo->color = $color;
			$vehiculo->uso = $uso;
			$vehiculo->numeroMotor = $numeroMotor;
			// $vehiculo->addChild('numeroSerie', $numeroSerie);
			$vehiculo->combustible = $combustible;
			$vehiculo->cilindros = $cilindros;
			$vehiculo->transmision = $transmision;
			// $vehiculo->addChild('linea', $linea);
            break;
        }
    }

    echo $xml->asXML('../db.xml');

    echo("Consulta ejecutada \n");
} else {
    echo ("Consulta fallida \n");
}
cerrar($con);


?>
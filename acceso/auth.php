<?php

// Para autenticar archivo/ruta: 
// include('../acceso/auth.php');

session_start();

if(!$_SESSION['username']){
    // Reemplazar con el login
    header("location:login.html");
}

?>
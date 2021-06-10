<?php
error_reporting(E_ALL);  
require_once("./class/class.Panel.php");
//
$panel = new Panel();
$respuesta = $panel->callMethodRol($_POST);
echo json_encode($respuesta);
//
?>
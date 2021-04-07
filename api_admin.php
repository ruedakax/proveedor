<?php
error_reporting(E_ALL);  
require_once("./class/class.Panel.php");
//
$panel = new Panel();
$respuesta = $panel->callMethod($_POST);
echo json_encode($respuesta);
//
?>
<?php
error_reporting(E_ALL);  
require_once("./class/class.Panel.php");
//
$panel = new Panel($_REQUEST['tipo'],$_REQUEST['accion']);
$panel->callPanel();
$respuesta = $panel->callAccion($_REQUEST);
echo json_encode($respuesta);
//
?>
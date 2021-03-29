<?php
error_reporting(E_ALL);  
require_once("./class/class.Panel.php");
//
$panel = new Panel($_REQUEST['tipo'],$_REQUEST['accion']);
$panel->callPanel();
$respuesta = $panel->tipo!=='panel_9'?$panel->callAccion($_REQUEST):$panel->callAccion($_REQUEST,$_FILES);
echo json_encode($respuesta);
//
?>
<?php
  error_reporting(E_ALL);
  require_once("./class/class.Panel.php");
  require_once("./class/class.Admin.php");

  $admin = new Admin();
  $admin->conn = SOConexion::conexion_db();
  $res = $admin->consultar(base64_decode($_GET['i']));  
  //
  if($res === FALSE || $res['estado'] === 'D' || $admin->checkDate($res['fecha_expira'])===FALSE){
    echo "<p>ERROR : ¡No existe una programación para este enlace o el enlace ya expiró!</p>";
    die;
  }
  //
  $panel   = new Panel('panel_1','consultar');
  $panel->callPanel();
  $datos = $panel->callAccion(array($_GET['i']));
  //
  $inscrito = 'Usted está inscrito como %s. Marque la misma opción si desea mantenerla, de lo contrario marque su preferencia.';
  $no_inscrito = '¿Cómo desea inscribirse en el registro?';  
  $mensajeInicio = isset($datos['datos']['tipo_registro'])?sprintf($inscrito,strtoupper($datos['datos']['tipo_registro'])):$no_inscrito;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="noindex">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/icon/icon32X32.png">
    <title>SP - Registro &Uacute;nico Clientes, Proveedores Y Contratistas.</title>
    <link rel="stylesheet" type="text/css" href="./css/proveedor.css">
  </head>
  <body>
    <noscript>
     <style type="text/css">
        #container {display:none;}
     </style>
     <p>JAVASCRIPT ESTA INACTIVO</p>
     <p>Sólo puede hacer uso de este sitio si JAVASCRIPT está activo</p>
    </noscript>          
    <div id="container">
      <div id="overlay" class="oculto">
        <div class="loader__element"></div>
      </div>      
      <div class="form-box">
        <div id="top_menu">
            <div id="logo"></div><div id="titulo">Registro Único Clientes, Proveedores y Contratistas <span class="pequena">(AYL-F-017).</span></div>
        </div>
      </div>
      <div class="form-box bottom" id="inicio">
        <div class="c-form">
          <fieldset>
              <label class="c-form-label negrita" for="tipo_registro"><?php echo $mensajeInicio?></label><br/>
              <label class="alt_label c-form-label"><input type="radio" name="tipo_registro" class="tipo_registro" value="cliente">CLIENTE</label> 
              <label class="alt_label c-form-label"><input type="radio" name="tipo_registro" class="tipo_registro" value="proveedor">PROVEEDOR</label>
              <label class="alt_label c-form-label"><input type="radio" name="tipo_registro" class="tipo_registro" value="contratista">CONTRATISTA &oacute; SUBCONTRATISTA</label>                
          </fieldset>  
        </div>
      </div>
      <form class="all-form" name="c-form" action="./api.php" method="post" id="c-form"></form>
      <!-- INCIO -  C A B E C E R A   I N F O R M A C I O N   -->      
      <div id="buttonPanel" class="form-box bottom oculto" data-current="0" data-paneles="{}">
        <div class="c-form">
          <div class="two-columns">
            <button class="c-form-btn oculto" type="button" id="volver">VOLVER</button>
            <button class="c-form-btn" type="button" id="enviar" data-tipo-persona="" data-tipo-registro="" data-nit="<?php echo $_GET['i']?>">SIGUIENTE</button>
          </div>
        </div>
      </div>
      <div class="form-box">
        <div id="footer">
          Carrera 74 No. 28-29, Medellín - (94) 341 76 00 - (094) 341 74 45 - info@sp.com.co
        </div>
      </div>
    </div>
    <script type="module" src="./js/datosProveedor.js"></script>    
  </body>
</html>
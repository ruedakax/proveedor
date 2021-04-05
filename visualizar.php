<?php
  error_reporting(E_ALL);
  require_once("./class/class.Panel.php");  
  //
  $panel   = new Panel('panel_1','consultar');
  $panel->callPanel();
  $datos = $panel->callAccion(array($_GET['i']))['datos'];  
  $panel = NULL;
  if(!isset($datos['tipo_registro'])){
    echo "<p>¡Error!</p>";
    die;
  }
  //  
  $panel   = new Panel('panel_1','mostrar');
  $panel->callPanel();
  $panelToShow = $panel->callAccion($_GET);
  //    
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
    <!--script src="js/datosProveedor.js"></script-->
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
          <div id="logo"></div>
          <div id="titulo">Visualización de registro :&nbsp;<?php echo strtoupper($datos['tipo_registro'])?></div>
        </div>
      </div>
      <div class="form-box">        
          <div id="tabs" class="tab" data-tipo-persona="<?php echo $_GET['tipo_persona']?>" data-tipo-registro="<?php echo $_GET['tipo_registro']?>" data-nit="<?php echo $_GET['i']?>">
            <button class="tablinks" id='panel_1'>Sección Uno</button>
            <button class="tablinks" id='panel_2'>Sección Dos</button>
            <button class="tablinks" id='panel_3'>Sección Tres</button>
            <button class="tablinks" id='panel_5'>Sección Cinco</button>
            <button class="tablinks" id='panel_6'>Sección Seis</button>
            <button class="tablinks" id='panel_7'>Sección Siete</button>
            <button class="tablinks" id='panel_8'>Sección Ocho</button>
            <button class="tablinks" id='panel_9'>Sección Anexos</button>
          </div>                  
      </div>
      <form class="all-form" name="c-form" action="./api.php" method="post" id="c-form">
        <?php 
          echo $panelToShow;
        ?>
      </form>            
      </form>      
      <div class="form-box">
        <div id="footer">
          Carrera 74 No. 28-29, Medellín - (94) 341 76 00 - (094) 341 74 45 - info@sp.com.co
        </div>
      </div>
    </div>
    <script type="module" src="./js/visualizacion.js"></script>
  </body>
</html>
<?php
  session_start();
  error_reporting(E_ALL);
  require_once("./class/class.Panel.php");  
  //
  $nit = isset($_GET['i'])?$_GET['i']:NULL;
  $panel  = new Panel();
  //
  $datos['accion'] = 'consultar';
  $datos['usuario'] = isset($_SESSION['USUARIO'])?$_SESSION['USUARIO']:'';
  $roles = $panel->callMethodRol($datos);
  $roles['res']||!empty($roles['datos']['permisos'])?'':die("¡La sesión expiró ó no cuenta con permisos para esta aplicación!");
  //armado de menu segun permisos
  $datos['accion'] = 'menu';
  $datos['permisos'] = $roles['datos']['permisos'];
  $menu = $panel->callMethodRol($datos);
  //  
  $panel  = new Panel('panel_1','consultar');
  $panel->callPanel();
  $datos = $panel->callAccion(array($nit))['datos'];  
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
    <title>SP - Visualización de Registro</title>
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
          <div id="tabs" class="tab" data-usuario="<?php echo $_SESSION['USUARIO']?>"  data-nit="<?php echo $_GET['i']?>">
            <?php
              echo $menu;
            ?>
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
    <script type="module" src="./js/visualizar.js"></script>
  </body>
</html>
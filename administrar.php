<?php
  error_reporting(E_ALL);
  require_once("./class/class.Panel.php");
  //
  $panel = new Panel();
  $datos['accion'] = 'listar';
  $lista = $panel->callMethod($datos);
  //
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="noindex">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/icon/icon32X32.png">
    <title>SP - Administración del Registro.</title>
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
          <div id="titulo">Administración del Registro.&nbsp;</div>
        </div>
      </div>
      <div class="form-box">
        <div class="c-form">
          <form class="" name="c-form" action="" method="post" id="">
            <div class="three-columns">
              <fieldset>
                  <label class="c-form-label negrita" for="nit">NIT<span class="c-form-required"> *</span></label>
                  <input id="nit" class="c-form-input" type="text" name="nit" placeholder="Digite el número" value="1234567">
              </fieldset>
              <fieldset>
                  <label class="c-form-label negrita" for="email">Email<span class="c-form-required"> *</span></label>
                  <input id="email" class="c-form-input" type="text" name="email" placeholder="Email" value="prueba">
              </fieldset>              
              <fieldset>
                <label class="c-form-label negrita" for="email">&nbsp;</label>
                <button class="myButton button-martop" type="button" id="programar">Programar</button>
              </fieldset>            
            </div>
          </form>
        </div>
      </div>            
      <div class="form-box"><h3>Listado de Proveedores</h3></div>
      <div class="form-box">
        <div class="c-form">
            <div class="four-columns">
              <fieldset>
                  <label class="c-form-label negrita">NIT</label>                
              </fieldset>
              <fieldset>
                <label class="c-form-label negrita">Email</label>
              </fieldset>              
              <fieldset>
                <label class="c-form-label negrita">Fase</label>
              </fieldset>
              <fieldset>
              <label class="c-form-label negrita">Fecha Expira</label>
              </fieldset>              
            </div>
        </div>
      </div>
      <div class="form-box">
        <div class="c-form" id="lista">
            <?php 
              echo $lista;
            ?>
        </div>        
      </div>
      <div class="form-box">
        <div id="footer">
          Carrera 74 No. 28-29, Medellín - (94) 341 76 00 - (094) 341 74 45 - info@sp.com.co
        </div>
      </div>
    </div>
    <script type="module" src="./js/administrar.js"></script>
  </body>
</html>
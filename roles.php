<?php
  error_reporting(E_ALL);
  require_once("./class/class.Panel.php");
  //
  $panel = new Panel();
  $datos['accion'] = 'listarUsuarios';
  $datos['tipo_bd'] = 'bmps';
  $listaUsuarios = $panel->callMethodRol($datos);
  //
  $datos['accion'] = 'listar';
  $datos['tipo_bd'] = '';
  $lista = $panel->callMethodRol($datos);
  //
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="noindex">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/icon/icon32X32.png">
    <title>SP - Administración de Roles.</title>
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
          <div id="logo"></div>
          <div id="titulo">Administración de Roles.&nbsp;</div>
        </div>
      </div>
      <div class="form-box">
          <div id="tabs" class="tab">
            <button class="tablinks" id='administracion'>Panel de registros</button>
            <button class="tablinks" id='usuarios'>Panel de permisos</button>
          </div>
      </div>
      <div class="form-box">
        <div class="c-form">
          <form class="" name="c-form" action="" method="post" id="roles">
            <div class="three-columns">
              <fieldset>
                  <label class="c-form-label negrita" for="usuario">Usuario<span class="c-form-required"> *</span></label>
                  <input list="nombres" id="usuario" class="c-form-input" name="usuario" value="">
                  <datalist id="nombres">
                    <?php echo $listaUsuarios?>
                  </datalist>
              </fieldset>
              <fieldset>
                  <label class="c-form-label negrita" for="secciones">Accesso a:<span class="c-form-required"> *</span></label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="panel_1">Panel Uno.</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="panel_2">Panel Dos.</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="panel_3">Panel Tres.</label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="panel_5">Panel Cinco.</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="panel_6">Panel Seis.</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="panel_7">Panel Siete.</label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="panel_8">Panel Ocho.</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="panel_9">Panel Nueve.</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="secciones[]" class="secciones" value="administracion"><u>Administración.</u></label>
              </fieldset>              
              <fieldset>
                <label class="c-form-label negrita" for="email">&nbsp;</label>
                <button class="myButton button-martop" type="button" id="otorgar">Otorgar Permisos</button>
              </fieldset>            
            </div>
          </form>
        </div>
      </div>
      <div class="form-box"><h3>Búsqueda&nbsp;<span id="load_search" class="oculto"><img src="./images/loading.gif" width="20px" height="20px"></span></h3></div>
      <div class="form-box">
        <div class="c-form">          
            <div class="two-columns">              
              <fieldset>                  
                  <label class="c-form-label negrita" for="email">&nbsp;</label> 
                  <input id="busqueda" class="c-form-input" type="text" name="busqueda" placeholder="Indicio de búsqueda (NIT ó nombre)" value="">
              </fieldset>              
              <fieldset>                
                <label class="c-form-label negrita" for="email">&nbsp;</label>
                <button class="myButton button-martop" type="button" id="buscar">Buscar</button>
              </fieldset>            
            </div>          
        </div>
      </div>
      <div class="form-box"><h3>Listado de Verificadores</h3></div>
      <div class="form-box">
        <div class="c-form">
            <div class="five-columns">
              <fieldset>
                  <label class="c-form-label negrita">Usuario</label>                
              </fieldset>
              <fieldset>
                <label class="c-form-label negrita">Nombre</label>
              </fieldset>              
              <fieldset>
                <label class="c-form-label negrita">Email</label>
              </fieldset>
              <fieldset>
               <label class="c-form-label negrita">Permisos</label>
              </fieldset>
              <fieldset>
               <label class="c-form-label negrita">Eliminar</label>
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
    <script type="module" src="./js/roles.js"></script>
  </body>
</html>
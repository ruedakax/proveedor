import {showHide,showHideByCheck} from './general.js'
import {setPanel} from './envio.js'
import {addNodo} from './nodos.js'

function preparePanel1(){
    document['c-form'].innerHTML = panel_1
    asociarEventos()    
}
////*Envio del panel */    
function savePanel1(){
  const objForm = document.querySelector('#c-form')  
  const tipo = 'panel_1'
  const accion = 'guardar'
  setPanel(objForm,tipo,accion).then(function(response){
    const data = JSON.parse(response);    
    console.log(data)
  });  
}
/*asociacion de eventos para elementos del panel que lo requieren*/
function asociarEventos(){
    window.tipo_persona.selectedIndex = 0;

    window.tipo_persona.addEventListener('change', () => showHide('juridica'),false)

    document.querySelectorAll('#autoretenedor').forEach(item => {
      item.addEventListener('change', () => showHideByCheck(item,'autoretenedor'))
    });

    document.querySelectorAll('.checkSucursales').forEach(item => {        
        item.addEventListener('change', () => {
          showHideByCheck(item,'areaSucursales')
          if(item.value==='NO')
            window.areaSucursales.innerHTML = '';
        })
    });

    document.querySelector('#agregarBtn').addEventListener('click', () => {
      const container =  document.querySelector('#areaSucursales')
      addNodo(container,'dir_suc_',1,'nodoSucursal')
    })  
}

const panel_1 = `<!-- I N I C I O   -  C A B E C E R A   I N F O R M A C I O N   G E N E R A L-->
<div class="form-box panel_1"><h3>1. Información General<i class="arrow down"></i></h3></div>
<div class="form-box panel_1" id="panel_1">
  <div class="c-form">
    <div class="two-columns">
      <fieldset>
        <label class="c-form-label negrita" for="nombre">Nombre &oacute; Raz&oacute;n Social<span class="c-form-required"> *</span></label>
        <input id="nombre" class="c-form-input" type="text" name="nombre" placeholder="Nombre" value="Pepito Perez">
      </fieldset>
      <fieldset>
        <label class="c-form-label negrita" for="nit">NIT/CC<span class="c-form-required"> *</span></label>
        <input id="nit" class="c-form-input" type="text" name="nit" placeholder="Nit/CC" value="42342342344">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="tipo_persona">Tipo Persona<span class="c-form-required"> *</span></label>
          <select name="tipo_persona" id="tipo_persona" class="c-form-input">
              <option value="natural">NATURAL</option>
              <option value="juridica">JURIDICA</option>
          </select>
      </fieldset>
    </div>          
    <div class="two-columns item-sucursal oculto" id="juridica">
      <fieldset>
        <label class="c-form-label negrita" for="nombre_juridica">Nombre Representante Legal<span class="c-form-required"> *</span></label>
        <input id="rep_legal" class="c-form-input" type="text" name="nombre_juridica" placeholder="Nombre" value="Pepito Castro">
      </fieldset>
      <fieldset>
        <label class="c-form-label negrita" for="rep_documento">Documento<span class="c-form-required"> *</span></label>
        <input id="rep_documento" class="c-form-input" type="text" name="rep_documento" placeholder="Documento" value="53434534534">
      </fieldset>
      <fieldset>
        <label class="c-form-label negrita" for="rep_email">Email<span class="c-form-required"> *</span></label>
        <input id="rep_email" class="c-form-input" type="text" name="rep_email" placeholder="Email" value="prueba@prueba.co">
      </fieldset>
    </div>
    <fieldset>
        <label class="c-form-label negrita" for="tipo_sociedad">Tipo Sociedad<span class="c-form-required"> *</span></label><br/>
        <label class="alt_label c-form-label"><input type="radio" name="tipo_sociedad" value="privada">Privada</label>
        <label class="alt_label c-form-label"><input type="radio" name="tipo_sociedad" value="publica">Pública</label>
        <label class="alt_label c-form-label"><input type="radio" name="tipo_sociedad" value="mixta">Mixta</label>
        <label class="alt_label c-form-label"><input type="radio" name="tipo_sociedad" value="ESAL">Entidad Sin Ánimo de Lucro</label>
    </fieldset>            
    <div class="two-columns">
      <fieldset>
          <label class="c-form-label negrita" for="contacto_nombre">Contacto<span class="c-form-required"> *</span></label>
          <input id="contacto_nombre" class="c-form-input" type="text" name="contacto_nombre" placeholder="Nombre Completo del Contacto" value="Juana Perez">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="contacto_celular">Celular<span class="c-form-required"> *</span></label>
          <input id="contacto_celular" class="c-form-input" type="text" name="contacto_celular" placeholder="Número Celular" value="3200000000">
      </fieldset>              
    </div>
    <div class="three-columns">
      <fieldset>
          <label class="c-form-label negrita" for="contacto_email">Email<span class="c-form-required"> *</span></label>
          <input id="contacto_email" class="c-form-input" type="text" name="contacto_email" placeholder="email" value="prueba@prueba">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="contacto_site">Página Web<span class="c-form-required"> *</span></label>
          <input id="contacto_site" class="c-form-input" type="text" name="contacto_site" placeholder="Página Web" value="www.site.com">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="contacto_telefono">Teléfono<span class="c-form-required"> *</span></label>
          <input id="contacto_telefono" class="c-form-input" type="text" name="contacto_telefono" placeholder="Télefono" value="3207890">
      </fieldset>
    </div>
    <div class="three-columns">
      <fieldset>
          <label class="c-form-label negrita" for="direccion">Dirección Oficina Principal<span class="c-form-required"> *</span></label>
          <input id="direccion" class="c-form-input" type="text" name="direccion" placeholder="Dirección" value="CL 40 90 22">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="pais">País<span class="c-form-required"> *</span></label>
          <input id="pais" class="c-form-input" type="text" name="pais" placeholder="País" value="Colombia">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="ciudad">Ciudad<span class="c-form-required"> *</span></label>
          <input id="ciudad" class="c-form-input" type="text" name="ciudad" placeholder="Ciudad" value="Medellín">
      </fieldset>
    </div>
    <fieldset>
        <label class="c-form-label negrita" for="sucursales">Posee Sucursales<span class="c-form-required">*</span></label><br/>
        <label class="alt_label c-form-label"><input type="radio" name="sucursales" class="checkSucursales" value="SI">SÍ</label>
        <label class="alt_label c-form-label"><input type="radio" name="sucursales" class="checkSucursales" value="NO" checked>NO</label>
        <button class="myButton areaSucursales oculto" type="button" id="agregarBtn">Agregar</button>
        <div id="areaSucursales" class="areaSucursales oculto"></div>
    </fieldset>
    <div class="two-columns">
      <fieldset>
          <label class="c-form-label negrita" for="reg_mercantil">No. Registro Mercantil<span class="c-form-required"> *</span></label>
          <input id="reg_mercantil" class="c-form-input" type="text" name="reg_mercantil" placeholder="Digite el número" value="244242434">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
          <input id="reg_fecha" class="c-form-input" type="text" name="fecha_mercantil" placeholder="AAAA-MM-DD" value="2021-02-21">
      </fieldset>              
    </div>            
    <div class="four-columns">
      <fieldset>
          <label class="c-form-label negrita" for="escritura_num">No. Escritura<span class="c-form-required"> *</span></label>
          <input id="escritura_num" class="c-form-input" type="text" name="escritura_num" placeholder="Digite el número" value="342342422">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="escritura_fecha">Fecha<span class="c-form-required"> *</span></label>
          <input id="escritura_fecha" class="c-form-input" type="text" name="escritura_fecha" placeholder="AAAA-MM-DD" value="2021-02-21">
      </fieldset>              
      <fieldset>
          <label class="c-form-label negrita" for="escritura_notaria">Notaria<span class="c-form-required"> *</span></label>
          <input id="escritura_notaria" class="c-form-input" type="text" name="escritura_notaria" placeholder="Digite el número" value="Notaria 15">
      </fieldset>
      <fieldset>
          <label class="c-form-label negrita" for="escritura_ciudad">Ciudad<span class="c-form-required"> *</span></label>
          <input id="escritura_ciudad" class="c-form-input" type="text" name="escritura_ciudad" placeholder="AAAA-MM-DD" value="2021-02-21">
      </fieldset>              
    </div>
    <div class="two-columns">
      <fieldset>
        <label class="c-form-label negrita" for="autoretenedor">Autoretenedor<span class="c-form-required"> *</span></label><br/>
        <label class="alt_label c-form-label"><input type="radio" name="autoretenedor" id="autoretenedor" value="SI">SÍ</label>
        <label class="alt_label c-form-label"><input type="radio" name="autoretenedor" id="autoretenedor" value="NO" checked>NO</label>
      </fieldset>
      <fieldset class="oculto autoretenedor item-sucursal">
          <label class="c-form-label negrita" for="retenedor_res">No. Resoluci&oacute;n<span class="c-form-required"> *</span></label>
          <input id="retenedor_res" class="c-form-input" type="text" name="retenedor_res" placeholder="No. Resolución">
      </fieldset>              
    </div>            
  </div>
</div>`    

export {preparePanel1,savePanel1}
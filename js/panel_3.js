import {showHideByCheck} from './general.js'

function preparePanel3(){
    const tipoPersona = document.querySelector('#enviar').dataset.tipoPersona
    document['c-form'].innerHTML = panel_3
    
    document.querySelectorAll('#i3_p1_check').forEach(item => {        
      showGestion(item,tipoPersona)
        item.addEventListener('change', () => {
          showHideByCheck(item,'i3_p1')
          showGestion(item,tipoPersona)
        })        
    });    

    document.querySelectorAll('#gi3_p1_check').forEach(item => {
        item.addEventListener('change', () => showHideByCheck(item,'gi3_p1'))
    });

    document.querySelectorAll('#gi3_p2_check').forEach(item => {
        item.addEventListener('change', () => showHideByCheck(item,'gi3_p2'))
    });   
}

function savePanel3(){

}
  
const panel_3 =  `<!-- INCIO -  C A B E C E R A   I N F O R M A C I O N   S I S T E M A S   G E S T I O N-->
<div class="form-box panel_3"><h3>3. Información de Sistemas de Gestión<i class="arrow down"></i></h3></div>
<div class="form-box panel_3" id="panel_3">
  <div class="c-form">
    <div class="break">
      <fieldset id="conGestion">
        <label class="c-form-label negrita" for="i3_p1_check">¿Posee certificado de Sistema de Gestión?<span class="c-form-required"> *</span></label><br/>
        <label class="alt_label c-form-label"><input type="checkbox" name="i3_p1_check" id="i3_p1_check" value="SI">SI</label>
        <label class="alt_label c-form-label"><input type="checkbox" name="i3_p1_check" id="i3_p1_check" value="NO" checked>NO</label><br/>
      </fieldset>
      <fieldset class="i3_p1 oculto">
        <label class="c-form-label negrita" for="i3_p1_certificado">Certificados<span class="c-form-required"> *</span></label><br/>
        <label class="alt_label c-form-label"><input type="checkbox" name="i3_p1_certificado" value="calidad">Calidad</label>
        <label class="alt_label c-form-label"><input type="checkbox" name="i3_p1_certificado" value="SST">Seguridad y Salud en el Trabajo</label>
        <label class="alt_label c-form-label"><input type="checkbox" name="i3_p1_certificado" value="ambiental">Ambiental</label>
        <label class="alt_label c-form-label"><input type="checkbox" name="i3_p1_certificado" value="enCertificacion">En Certificación</label><br/>
        <label class="c-form-label negrita" for="i3_p1_ec_asesora">Si La respuesta es <i>"En Certificacion"</i>, ingrese la firma asesora<span class="c-form-required"> *</span></label>
        <input id="i3_p1_ec_asesora" class="c-form-input" type="text" name="i3_p1_ec_asesora" placeholder="firma asesora" required>
      </fieldset>
    </div>
    <div id="sinGestion" class="oculto">
      <fieldset>
        <label class="c-form-label negrita item-sucursal" for="sucursales">SOLO  PARA PRODUCTORES, DISTRIBUIDORES O PRESTADORES DE SERVICIOS</label><br/>
      </fieldset>
      <div class="break">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p1_check">¿Posee controles de calidad?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p1_check" id="gi3_p1_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p1_check" id="gi3_p1_check" value="NO" checked>NO</label><br/>
          <label class="c-form-label negrita gi3_p1 oculto" for="gi3_p1_control_calidad">¿De qué tipo?<span class="c-form-required"> *</span></label>
          <input id="gi3_p1_control_calidad" class="c-form-input oculto gi3_p1" type="text" name="gi3_p1_control_calidad" placeholder="" required>
        </fieldset>
      </div>   
      <div class="break">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p2_check">¿Poseen su productos sellos de calidad?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p2_check" id="gi3_p2_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p2_check" id="gi3_p2_check" value="NO" checked>NO</label><br/>
          <label class="c-form-label negrita gi3_p2 oculto" for="gi3_p2_sellos">Mencione productos y normas<span class="c-form-required"> *</span></label>
          <input id="gi3_p2_sellos" class="c-form-input oculto gi3_p2" type="text" name="gi3_p2_sellos" placeholder="" required>
        </fieldset>
      </div> 
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p3_check">¿Cuenta con personal capacitado y calificado para la prestación de sus servicios?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p3_check" id="gi3_p3_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p3_check" id="gi3_p3_check" value="NO" checked>NO</label><br/>                    
        </fieldset>                
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p4_check">¿Verifica las materias primas que requieren sus servicios?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p4_check" id="gi3_p4_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p4_check" id="gi3_p4_check" value="NO" checked>NO</label><br/>
        </fieldset>
      </div> 
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p5_check">¿Posee certificados de los trabajos realizados a otros clientes?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p5_check" id="gi3_p5_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p5_check" id="gi3_p5_check" value="NO" checked>NO</label><br/>                    
        </fieldset>                
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p6_check">¿Cuenta con procedimientos escritos de los procesos involucrados en sus servicios?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p6_check" id="gi3_p6_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p6_check" id="gi3_p6_check" value="NO" checked>NO</label><br/>
        </fieldset>
      </div> 
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p7_check">¿Cuenta con procedimientos de control de productos no conforme?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p7_check" id="gi3_p7_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p7_check" id="gi3_p7_check" value="NO" checked>NO</label><br/>                    
        </fieldset>                
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p8_check">¿Cuenta con condiciones de almacenamiento que garantizan la calidad del producto?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p8_check" id="gi3_p8_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p8_check" id="gi3_p8_check" value="NO" checked>NO</label><br/>
        </fieldset>
      </div> 
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p9_check">¿El empaque de su producto facilita su identificación (fecha, lote)?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p9_check" id="gi3_p9_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p9_check" id="gi3_p9_check" value="NO" checked>NO</label><br/>                    
        </fieldset>                
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p10_check">¿Realiza una adecuada gestión de los residuos que genera, conforme a la legislación vigente?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p10_check" id="gi3_p10_check" value="SI">SI</label>
          <label class="alt_label c-form-label"><input type="checkbox" name="gi3_p10_check" id="gi3_p10_check" value="NO" checked>NO</label><br/>
        </fieldset>
      </div> 
    </div>
  </div>
</div>`

function showGestion(item,tipoPersona){
  console.log(item.getAttribute("checked"),item.value,tipoPersona)
  if(item.value === 'NO' && tipoPersona ==='juridica'){
    //console.log(item.getAttribute("checked"),item.value)
    window.conGestion.classList.remove('oculto')
    window.sinGestion.classList.remove('oculto')
  }else if(item.value === 'SI' && tipoPersona ==='juridica'){
    window.conGestion.classList.remove('oculto')
    window.sinGestion.classList.add('oculto')
  }else{
    window.conGestion.classList.add('oculto')
    window.sinGestion.classList.remove('oculto')
  }
}

export  {preparePanel3,savePanel3}
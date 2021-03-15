import {showHideByCheck} from './general.js'
import {addNodo} from './nodos.js'


function preparePanel2(){    
    
  document['c-form'].innerHTML = panel_2
    
      
    document.querySelectorAll('#i2_p6_check').forEach(item => {
        item.addEventListener('change', () => showHideByCheck(item,'i2_p6'))
    });

    document.querySelectorAll('#i2_p7_check').forEach(item => {
            item.addEventListener('change', () => showHideByCheck(item,'i2_p7'))
    });

    document.querySelectorAll('#i2_p9_check').forEach(item => {
        item.addEventListener('change', () => showHideByCheck(item,'i2_p9'))
    });   

    document.querySelector('#agregarRefBtn').addEventListener('click', () => {
      const container =  document.querySelector('#areaRefBancarias')
      addNodo(container,'refban_banco_',2,'nodoBanco')
    })
    
    document.querySelector('#agregarComBtn').addEventListener('click', () => {
      const container =  document.querySelector('#areaRefComerciales')
      addNodo(container,'refcom_empresa_',2,'nodoComercial')
  })
}

function savePanel2(){

}

const panel_2 = `<!-- I N I C I O  -  C A B E C E R A   I N F O R M A C I O N   COMERCIAL-->
          <div class="form-box panel_2"><h3>2. Información Comercial<i class="arrow up"></i></h3></div>
          <div class="form-box panel_2" id="panel_2">
            <div class="c-form">
              <div>
                <fieldset>
                  <label class="c-form-label negrita" for="nombre_juridica">Tipo Actividad<span class="c-form-required"> *</span></label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="tipo_actividad" value="contratista">Contratista</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="tipo_actividad" value="subcontratista">Subcontratista</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="tipo_actividad" value="productor">Productor</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="tipo_actividad" value="distribuidor">Distribuidor</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="tipo_actividad" value="importador">Importador</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="tipo_actividad" value="servicios">Servicios</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="tipo_actividad" value="comercializador">Comercializador</label>
                </fieldset> 
              </div>
              <div>
                <fieldset>
                  <label class="c-form-label negrita" for="nombre_juridica">Número de Empleados<span class="c-form-required"> *</span></label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="nro_empleados" value="0_50">Entre 0 - 50</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="nro_empleados" value="51_100">Entre 51 - 100</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="nro_empleados" value="mas_100">Más de 100</label>                  
                </fieldset> 
              </div>
              <div class="two-columns">
                <fieldset>
                    <label class="c-form-label negrita" for="regimen">Regimen<span class="c-form-required"> *</span></label><br/>
                    <label class="alt_label c-form-label"><input type="checkbox" name="regimen" value="privada">Gran Contribuyente</label>
                    <label class="alt_label c-form-label"><input type="checkbox" name="regimen" value="publica">Responsable IVA</label>
                    <label class="alt_label c-form-label"><input type="checkbox" name="regimen" value="mixta">Especial</label>
                    <label class="alt_label c-form-label"><input type="checkbox" name="regimen" value="ESAL">Simple</label>
                </fieldset>  
              </div>
              <div class="three-columns">
                <fieldset>
                  <label class="c-form-label negrita" for="cuenta_banco">Nombre de entidad Bancaria<span class="c-form-required"> *</span></label>
                  <input id="cuenta_banco" class="c-form-input" type="text" name="cuenta_banco" placeholder="Nombre Banco" required>
                </fieldset>              
                <fieldset>
                  <label class="c-form-label negrita" for="cuenta">No. Cuenta<span class="c-form-required"> *</span></label>
                  <input id="cuenta_banco" class="c-form-input" type="text" name="cuenta" placeholder="Número de cuenta" required>
                </fieldset> 
                <fieldset>
                  <label class="c-form-label negrita" for="regimen">Tipo cuenta<span class="c-form-required"> *</span></label><br/>                  
                  <label class="alt_label c-form-label"><input type="checkbox" name="cuenta_tipo" value="privada">Ahorros</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="cuenta_tipo" value="publica">Corriente</label>
                </fieldset>              
              </div>
              <div id="refBancarias">
                <fieldset>
                  <label class="c-form-label negrita item-sucursal" for="sucursales">Referencias Bancarias Incluyendo Patrimonios Autonomos ó Fiduciarias a Cargo ó a Favor de la Sociedad:</label><br/>                                
                </fieldset>
                <div id="areaRefBancarias" class="">                  
                  <div class="five-columns">                   
                    <fieldset>
                      <label class="c-form-label negrita" for="refban_banco_1">Banco<span class="c-form-required"> *</span></label>
                      <input id="refban_banco_1" class="c-form-input" type="text" name="refban_banco_1" placeholder="Banco" required>
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="refban_sucursal_1">Sucursal<span class="c-form-required"> *</span></label>
                      <input id="refban_sucursal_1" class="c-form-input" type="text" name="refban_sucursal_1" placeholder="Sucursal" required>
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="refban_cuenta_1">Nro. Cuenta<span class="c-form-required"> *</span></label>
                      <input id="refban_cuenta_1" class="c-form-input" type="text" name="refban_cuenta_1" placeholder="Número de cuenta" required>
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="refban_telefono_1">Teléfono<span class="c-form-required"> *</span></label>
                      <input id="refban_telefono_1" class="c-form-input" type="text" name="refban_telefono_1" placeholder="Teléfono" required>
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="refban_contacto_1">Persona Contacto<span class="c-form-required"> *</span></label>
                      <input id="refban_contacto_1" class="c-form-input" type="text" name="refban_contacto_1" placeholder="Nombre del contacto" required>
                    </fieldset>
                  </div>
                </div>                
                <button class="myButton" type="button" id="agregarRefBtn">Agregar Otra</button>
              </div>
              <div id="refComerciales">
                <fieldset>
                  <label class="c-form-label negrita item-sucursal" for="sucursales">Certificados de Experiencia :</label><br/>
                </fieldset>
                <div id="areaRefComerciales" class="">
                  <div class="three-columns">          
                    <fieldset>
                      <label class="c-form-label negrita" for="refcom_empresa_1">Empresa<span class="c-form-required"> *</span></label>
                      <input id="refcom_empresa_1" class="c-form-input" type="text" name="refcom_empresa_1" placeholder="Banco" required>
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="refcom_contacto_1">Contacto<span class="c-form-required"> *</span></label>
                      <input id="refcom_contacto_1" class="c-form-input" type="text" name="refcom_contacto_1" placeholder="Sucursal" required>
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="refban_cuenta_1">Cupos<span class="c-form-required"> *</span></label>
                      <input id="refcom_cupos_1" class="c-form-input" type="text" name="refcom_cupos_1" placeholder="Número de cuenta" required>
                    </fieldset>
                  </div>
                </div>       
                <button class="myButton" type="button" id="agregarComBtn">Agregar Otro</button>
              </div>
              <div class="break">
                <fieldset>
                  <label class="c-form-label negrita" for="i2_p6_check">¿Suministra productos y/o servicios a otros clientes similares a nuestra empresa?<span class="c-form-required"> *</span></label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p6_check" id="i2_p6_check" value="SI">SI</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p6_check" id="i2_p6_check" value="NO" checked>NO</label><br/>
                  <label class="c-form-label negrita i2_p6 oculto" for="i2_p6_empresas">¿Cuáles Empresas?<span class="c-form-required"> *</span></label>
                  <input id="i2_p6_empresas" class="c-form-input oculto i2_p6" type="text" name="i2_p6_empresas" placeholder="Empresas" required>
                </fieldset>
              </div>              
              <div class="break">
                <fieldset>
                  <label class="c-form-label negrita" for="i2_p7_check">¿Ofrece créditos para pago?<span class="c-form-required"> *</span></label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p7_check" id="i2_p7_check" value="SI">SI</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p7_check" id="i2_p7_check" value="NO" checked>NO</label><br/>
                  <label class="c-form-label negrita i2_p7 oculto" for="i2_p7_plazo">Plazo<span class="c-form-required"> *</span></label>
                  <select name="i2_p7_plazo" id="i2_p7_plazo" class="c-form-input oculto i2_p7">
                    <option value="30">30 días</option>
                    <option value="60">60 días</option>
                    <option value="90">90 días</option>
                  </select>
                </fieldset>
              </div>
              <div class="break">
                <fieldset>
                  <label class="c-form-label negrita" for="i2_p8_check">¿Puede entregar y/o suministrar productos y/o servicios a nivel nacional?<span class="c-form-required"> *</span></label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p8_check" id="i2_p8_check" value="SI">SI</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p8_check" id="i2_p8_check" value="NO" checked>NO</label><br/>                  
                </fieldset>
              </div>
              <div class="break">
                <fieldset>
                  <label class="c-form-label negrita" for="i2_p9_check">¿Ofrece servicios postventa?<span class="c-form-required"> *</span></label><br/>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_check" id="i2_p9_check" value="SI">SI</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_check" id="i2_p9_check" value="NO" checked>NO</label><br/>                  
                </fieldset>                
                <fieldset class="i2_p9 oculto">
                  <label class="c-form-label negrita " for="i2_p9_postventa">Servicios<span class="c-form-required"> *</span></label><br/>                  
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa" value="garantia">Garantias</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa" value="asesoria">Asesoria</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa" value="Asistencia tecnica">Asistencia Técnica</label>
                  <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa" value="devolucion">Devolucion</label>                  
                </fieldset>
              </div>              
            </div>
          </div>`

export  {preparePanel2,savePanel2}

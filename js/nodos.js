function remove(objeto){
    objeto.parentElement.parentElement.remove()
}

function addNodo(contenedor,texto_id,inicio,nodo){    
    let id = inicio
    let indice = document.querySelector(`#${texto_id}${id}`)    
    while(indice){
        id++
        indice = document.querySelector(`#${texto_id}${id}`)
    }
    
    const nodos = {
        'nodoSucursal': `<div class='close'><span class="x">x</span></div>
                            <div class="three-columns item-sucursal">                   
                            <fieldset>
                            <!--label class="c-form-label negrita" for="dir_suc_${id}">Dirección Oficina Principal<span class="c-form-required"> *</span></label-->
                            <input id="dir_suc_${id}" class="c-form-input" type="text" name="dir_suc_${id}" placeholder="Dirección">
                            </fieldset>
                            <fieldset>
                            <!--label class="c-form-label negrita" for="pais_suc_${id}">País<span class="c-form-required"> *</span></label-->
                            <input id="pais_suc_${id}" class="c-form-input" type="text" name="pais_suc_${id}" placeholder="País">
                            </fieldset>
                            <fieldset>
                            <!--label class="c-form-label negrita" for="ciudad_suc_${id}">Ciudad<span class="c-form-required"> *</span></label-->
                            <input id="ciudad_suc_${id}" class="c-form-input" type="text" name="ciudad_suc_${id}" placeholder="Ciudad">
                            </fieldset>
                        </div>`,
        'nodoBanco': `<div class='close'><span class="x">x</span></div>
                        <div class="five-columns item-banref">
                            <fieldset>
                                <!--label class="c-form-label negrita" for="refban_banco_${id}">Banco<span class="c-form-required"> *</span></label-->
                                <input id="refban_banco_${id}" class="c-form-input" type="text" name="refban_banco_${id}" placeholder="Banco">
                            </fieldset>
                            <fieldset>
                                <!--label class="c-form-label negrita" for="refban_sucursal_${id}">Sucursal<span class="c-form-required"> *</span></label-->
                                <input id="refban_sucursal_${id}" class="c-form-input" type="text" name="refban_sucursal_${id}" placeholder="Sucursal">
                            </fieldset>
                            <fieldset>
                                <!--label class="c-form-label negrita" for="refban_cuenta_${id}">Nro. Cuenta<span class="c-form-required"> *</span></label-->
                                <input id="refban_cuenta_${id}" class="c-form-input" type="text" name="refban_cuenta_${id}" placeholder="Número de cuenta">
                            </fieldset>
                            <fieldset>
                                <!--label class="c-form-label negrita" for="refban_telefono_${id}">Teléfono<span class="c-form-required"> *</span></label-->
                                <input id="refban_telefono_${id}" class="c-form-input" type="text" name="refban_telefono_${id}" placeholder="Teléfono">
                            </fieldset>
                            <fieldset>
                                <!--label class="c-form-label negrita" for="refban_contacto_${id}">Persona Contacto<span class="c-form-required"> *</span></label-->
                                <input id="refban_contacto_${id}" class="c-form-input" type="text" name="refban_contacto_${id}" placeholder="Nombre del contacto">
                            </fieldset>
                        </div>`,
        'nodoComercial': `<div class='close'><span class="x">x</span></div>
                          <div class="three-columns item-banref">                   
                            <fieldset>
                                <!--label class="c-form-label negrita" for="refcom_empresa_${id}">Empresa<span class="c-form-required"> *</span></label-->
                                <input id="refcom_empresa_${id}" class="c-form-input" type="text" name="refcom_empresa_${id}" placeholder="Empresa">
                            </fieldset>
                            <fieldset>
                                <!--label class="c-form-label negrita" for="refcom_contacto_${id}">Contacto<span class="c-form-required"> *</span></label-->
                                <input id="refcom_contacto_${id}" class="c-form-input" type="text" name="refcom_contacto_${id}" placeholder="Sucursal">
                            </fieldset>
                            <fieldset>
                                <!--label class="c-form-label negrita" for="refban_cuenta_${id}">Cupos<span class="c-form-required"> *</span></label-->
                                <input id="refcom_cupos_${id}" class="c-form-input" type="text" name="refcom_cupos_${id}" placeholder="Cupo">
                            </fieldset>                    
                        </div>`,
        'nodoAccionistas':`<div class='close'><span class="x">x</span></div>
                          <div class="four-columns item-banref">                   
                            <fieldset>                            
                            <input id="acci_nombre_${id}" class="c-form-input" type="text" name="acci_nombre_${id}" placeholder="Nombre">
                            </fieldset>
                            <fieldset>                            
                            <input id="acci_nit_${id}" class="c-form-input" type="text" name="acci_nit_${id}" placeholder="Número Nit/CC">
                            </fieldset>
                            <fieldset>                            
                            <input id="acci_porcentaje_${id}" class="c-form-input" type="text" name="acci_porcentaje_${id}" placeholder="">
                            </fieldset>
                            <fieldset>                            
                            <input id="acci_vinculado_${id}" class="c-form-input" type="text" name="acci_vinculado_${id}" placeholder="SI ó NO - NOMBRE DEL VINCULADO">
                            </fieldset>                    
                        </div>`,
        'nodoSociedades': `<div class='close'><span class="x">x</span></div>
                           <div class="four-columns item-banref">                   
                            <fieldset>
                            <label class="c-form-label negrita" for="socied_nombre_1">Nombre Accionista<span class="c-form-required"> *</span></label>
                            <input id="socied_nombre_1" class="c-form-input" type="text" name="socied_nombre_1" placeholder="Nombre">
                            </fieldset>
                            <fieldset>
                            <label class="c-form-label negrita" for="socied_identificacion_1">No. de Identificación<span class="c-form-required"> *</span></label>
                            <input id="socied_identificacion_1" class="c-form-input" type="text" name="socied_identificacion_1" placeholder="Número Nit/CC">
                            </fieldset>
                            <fieldset>
                            <label class="c-form-label negrita" for="socied_empresa_1">Empresa de la cual es Accionista<span class="c-form-required"> *</span></label>
                            <input id="socied_empresa_1" class="c-form-input" type="text" name="socied_empresa_1" placeholder="Nombre de la empresa">
                            </fieldset>
                            <fieldset>
                            <label class="c-form-label negrita" for="socied_porcentaje_1">% de Participación<span class="c-form-required"> *</span></label>
                            <input id="socied_porcentaje_1" class="c-form-input" type="text" name="socied_porcentaje_1" placeholder="%">
                            </fieldset>                    
                           </div>`,
        'nodoContactosPro':`<div class='close'><span class="x">x</span></div>
                           <div class="four-columns item-banref">                   
                            <fieldset>
                            <label class="c-form-label negrita" for="contacpro_nombre_1">Nombre<span class="c-form-required"> *</span></label>
                            <input id="contacpro_nombre_1" class="c-form-input" type="text" name="contacpro_nombre_1" placeholder="Nombre Completo">
                            </fieldset>
                            <fieldset>
                            <label class="c-form-label negrita" for="contacpro_identificacion_1">No. de Identificación<span class="c-form-required"> *</span></label>
                            <input id="contacpro_identificacion_1" class="c-form-input" type="text" name="contacpro_identificacion_1" placeholder="Número Nit/CC">
                            </fieldset>
                            <fieldset>
                            <label class="c-form-label negrita" for="contacpro_telefono_1">Teléfono<span class="c-form-required"> *</span></label>
                            <input id="contacpro_telefono_1" class="c-form-input" type="text" name="contacpro_telefono_1" placeholder="Teléfono">
                            </fieldset>
                            <fieldset>
                            <label class="c-form-label negrita" for="contacpro_email_1">Correo Electrónico<span class="c-form-required"> *</span></label>
                            <input id="contacpro_email_1" class="c-form-input" type="text" name="contacpro_email_1" placeholder="email">
                            </fieldset>                    
                           </div>`,
        'nodoContactos':`<div class='close'><span class="x">x</span></div>
                        <div id="areaContactos" class="">                  
                        <div class="four-columns item-banref">                   
                        <fieldset>
                            <label class="c-form-label negrita" for="contacto_nombre_1">Nombre<span class="c-form-required"> *</span></label>
                            <input id="contacto_nombre_1" class="c-form-input" type="text" name="contacto_nombre_1" placeholder="Nombre Completo">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="contacto_identificacion_1">No. de Identificación<span class="c-form-required"> *</span></label>
                            <input id="contacto_identificacion_1" class="c-form-input" type="text" name="contacto_identificacion_1" placeholder="Número Nit/CC">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="contacto_telefono_1">Teléfono<span class="c-form-required"> *</span></label>
                            <input id="contacto_telefono_1" class="c-form-input" type="text" name="contacto_telefono_1" placeholder="Teléfono">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="contacto_email_1">Correo Electrónico<span class="c-form-required"> *</span></label>
                            <input id="contacto_email_1" class="c-form-input" type="text" name="contacto_email_1" placeholder="email">
                        </fieldset>                   
                        </div>
                    </div>`,
    }
    
    const wrapper = document.createElement('div');
    wrapper.innerHTML = nodos[nodo] 
    contenedor.appendChild(wrapper)
    //incluimos la accion de borrar en el nodo agregado
    document.querySelectorAll('.x').forEach(item => {
        item.addEventListener('click', () =>  remove(item),false)        
    })
}

export {addNodo}
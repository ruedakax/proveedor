<!-- I N I C I O  -  C A B E C E R A   I N F O R M A C I O N   COMERCIAL-->
<div class="form-box panel_2"><h3>2. Información Comercial<i class="arrow up"></i></h3></div>
<div class="form-box panel_2" id="panel_2">
    <div class="c-form">
        <div>
            <fieldset>
                <label class="c-form-label negrita" for="nombre_juridica">Tipo Actividad<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="radio" name="tipo_actividad" value="contratista" <?php echo @$datos['tipo_actividad']=="contratista"?'checked':''?>>Contratista</label>
                <label class="alt_label c-form-label"><input type="radio" name="tipo_actividad" value="subcontratista" <?php echo @$datos['tipo_actividad']=="subcontratista"?'checked':''?>>Subcontratista</label>
                <label class="alt_label c-form-label"><input type="radio" name="tipo_actividad" value="productor" <?php echo @$datos['tipo_actividad']=="productor"?'checked':''?>>Productor</label>
                <label class="alt_label c-form-label"><input type="radio" name="tipo_actividad" value="distribuidor" <?php echo @$datos['tipo_actividad']=="distribuidor"?'checked':''?>>Distribuidor</label>
                <label class="alt_label c-form-label"><input type="radio" name="tipo_actividad" value="importador" <?php echo @$datos['tipo_actividad']=="importador"?'checked':''?>>Importador</label>
                <label class="alt_label c-form-label"><input type="radio" name="tipo_actividad" value="servicios" <?php echo @$datos['tipo_actividad']=="servicios"?'checked':''?>>Servicios</label>
                <label class="alt_label c-form-label"><input type="radio" name="tipo_actividad" value="comercializador" <?php echo @$datos['tipo_actividad']=="comercializador"?'checked':''?>>Comercializador</label>
            </fieldset> 
        </div>
        <div>
            <fieldset>
                <label class="c-form-label negrita" for="nombre_juridica">Número de Empleados<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="radio" name="nro_empleados" value="0_50" <?php echo @$datos['nro_empleados']=="0_50"?'checked':''?>>Entre 0 - 50</label>
                <label class="alt_label c-form-label"><input type="radio" name="nro_empleados" value="51_100" <?php echo @$datos['nro_empleados']=="51_100"?'checked':''?>>Entre 51 - 100</label>
                <label class="alt_label c-form-label"><input type="radio" name="nro_empleados" value="mas_100" <?php echo @$datos['nro_empleados']=="mas_100"?'checked':''?>>Más de 100</label>
            </fieldset> 
        </div>
        <div class="two-columns">
            <fieldset>
                <label class="c-form-label negrita" for="regimen">Regimen<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="radio" name="regimen" value="gran contribuyente" <?php echo @$datos['regimen']=="gran contribuyente"?'checked':''?>>Gran Contribuyente</label>
                <label class="alt_label c-form-label"><input type="radio" name="regimen" value="responsable iva" <?php echo @$datos['regimen']=="responsable iva"?'checked':''?>>Responsable IVA</label>
                <label class="alt_label c-form-label"><input type="radio" name="regimen" value="especial" <?php echo @$datos['regimen']=="especial"?'checked':''?>>Especial</label>
                <label class="alt_label c-form-label"><input type="radio" name="regimen" value="simple" <?php echo @$datos['regimen']=="simple"?'checked':''?>>Simple</label>
            </fieldset>  
        </div>
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita" for="cuenta_banco">Nombre de entidad Bancaria<span class="c-form-required"> *</span></label>
                <input id="cuenta_banco" class="c-form-input" type="text" name="cuenta_banco" placeholder="Nombre Banco" value="<?=@$datos['cuenta_banco']?>">
            </fieldset>              
            <fieldset>
                <label class="c-form-label negrita" for="cuenta">No. Cuenta<span class="c-form-required"> *</span></label>
                <input id="cuenta" class="c-form-input" type="text" name="cuenta" placeholder="Número de cuenta" value="<?=@$datos['cuenta']?>">
            </fieldset> 
            <fieldset>
                <label class="c-form-label negrita" for="regimen">Tipo cuenta<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="radio" name="cuenta_tipo" value="ahorros" <?php echo @$datos['cuenta_tipo']=="ahorros"?'checked':''?>>Ahorros</label>
                <label class="alt_label c-form-label"><input type="radio" name="cuenta_tipo" value="corriente" <?php echo @$datos['cuenta_tipo']=="corriente"?'checked':''?>>Corriente</label>
            </fieldset>              
        </div>
        <div id="refBancarias">
            <fieldset>
                <label class="c-form-label negrita item-sucursal" for="sucursales">Referencias Bancarias Incluyendo Patrimonios Autonomos ó Fiduciarias a Cargo ó a Favor de la Sociedad:</label><br/>                                
            </fieldset>
            <div id="areaRefBancarias" class="">
                <?php
                //solo tendrá dato si no se ha guardado una referencia antes
                echo $datos['inicial_refBancarias'];
                //inicio refBancarias
                foreach ($datos['list_refBancarias'] as $key => $value) {
                    $aclass = $key>0?"item-banref":'';
                    $aclose = $key>0?"<div class='close'><span class='x'>x</span></div>":'';                    
                ?>
                <div> 
                    <?php echo $aclose?>
                    <div class="five-columns <?php echo $aclass?>">
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_banco_<?php echo ($key)?>">Banco<span class="c-form-required"> *</span></label>
                            <input id="refban_banco_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_banco_<?php echo ($key)?>" placeholder="Banco" value="<?php echo $value['banco']?>">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_sucursal_<?php echo ($key)?>">Sucursal<span class="c-form-required"> *</span></label>
                            <input id="refban_sucursal_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_sucursal_<?php echo ($key)?>" placeholder="Sucursal" value="<?php echo $value['sucursal']?>">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_cuenta_<?php echo ($key)?>">Nro. Cuenta<span class="c-form-required"> *</span></label>
                            <input id="refban_cuenta_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_cuenta_<?php echo ($key)?>" placeholder="Número de cuenta" value="<?php echo $value['cuenta']?>">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_telefono_<?php echo ($key)?>">Teléfono<span class="c-form-required"> *</span></label>
                            <input id="refban_telefono_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_telefono_<?php echo ($key)?>" placeholder="Teléfono" value="<?php echo $value['telefono']?>">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_contacto_<?php echo ($key)?>">Persona Contacto<span class="c-form-required"> *</span></label>
                            <input id="refban_contacto_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_contacto_<?php echo ($key)?>" placeholder="Nombre del contacto" value="<?php echo $value['contacto']?>">
                        </fieldset>
                    </div>
                </div>
                <?php 
                } 
                //fin refBancarias
                ?>
            </div>                
            <button class="myButton" type="button" id="agregarRefBtn">Agregar Otra</button>
        </div>
        <div id="refComerciales">
            <fieldset>
                <label class="c-form-label negrita item-sucursal" for="sucursales">Certificados de Experiencia :</label><br/>
            </fieldset>
            <div id="areaRefComerciales" class="">
                <?php
                //solo tendrá dato si no se ha guardado una referencia antes
                echo $datos['inicial_refExperiencia'];
                //inicio refBancarias
                foreach ($datos['list_refExperiencia'] as $key => $value) {
                    $aclass = $key>0?"item-banref":'';
                    $aclose = $key>0?"<div class='close'><span class='x'>x</span></div>":'';
                    
                ?>
                <div> 
                    <?php echo $aclose?>
                    <div class="three-columns <?php echo $aclass?>">
                        <fieldset>
                            <label class="c-form-label negrita" for="refcom_empresa_<?php echo ($key)?>">Empresa<span class="c-form-required"> *</span></label>
                            <input id="refcom_empresa_<?php echo ($key)?>" class="c-form-input" type="text" name="refcom_empresa_<?php echo ($key)?>" placeholder="Banco" value="<?php echo $value['empresa']?>">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refcom_contacto_<?php echo ($key)?>">Contacto<span class="c-form-required"> *</span></label>
                            <input id="refcom_contacto_<?php echo ($key)?>" class="c-form-input" type="text" name="refcom_contacto_<?php echo ($key)?>" placeholder="Sucursal" value="<?php echo $value['contacto']?>">
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_cuenta_<?php echo ($key)?>">Cupos<span class="c-form-required"> *</span></label>
                            <input id="refcom_cupos_<?php echo ($key)?>" class="c-form-input" type="text" name="refcom_cupos_<?php echo ($key)?>" placeholder="Cupos" value="<?php echo $value['cupos']?>">
                        </fieldset>
                    </div>
                </div>
                <?php 
                } 
                //fin refBancarias
                ?>
            </div>       
            <button class="myButton" type="button" id="agregarComBtn">Agregar Otro</button>
        </div>
        <div class="break">
            <fieldset>
                <label class="c-form-label negrita" for="i2_p6_check">¿Suministra productos y/o servicios a otros clientes similares a nuestra empresa?<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="radio" name="i2_p6_check" id="i2_p6_check" value="SI" <?php echo @$datos['i2_p6_check']=="SI"?'checked':''?>>SI</label>
                <label class="alt_label c-form-label"><input type="radio" name="i2_p6_check" id="i2_p6_check" value="NO" <?php echo @$datos['i2_p6_check']=="NO"?'checked':''?>>NO</label><br/>
                <label class="c-form-label negrita i2_p6 <?php echo @$datos['i2_p6_check']=="NO"?@$datos['clase']:''?>" for="i2_p6_empresas">¿Cuáles Empresas?<span class="c-form-required"> *</span></label>
                <input id="i2_p6_empresas" class="c-form-input i2_p6 <?php echo @$datos['i2_p6_check']=="NO"?@$datos['clase']:''?>" type="text" name="i2_p6_empresas" placeholder="Empresas" value="<?=@$datos['i2_p6_empresas']?>">
            </fieldset>
        </div>              
        <div class="break">
            <fieldset>
                <label class="c-form-label negrita" for="i2_p7_check">¿Ofrece créditos para pago?<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="radio" name="i2_p7_check" id="i2_p7_check" value="SI" <?php echo @$datos['i2_p7_check']=="SI"?'checked':''?>>SI</label>
                <label class="alt_label c-form-label"><input type="radio" name="i2_p7_check" id="i2_p7_check" value="NO" <?php echo @$datos['i2_p7_check']=="NO"?'checked':''?>>NO</label><br/>
                <label class="c-form-label negrita i2_p7 <?php echo @$datos['i2_p7_check']=="NO"?@$datos['clase']:''?>" for="i2_p7_plazo">Plazo<span class="c-form-required"> *</span></label>
                <select name="i2_p7_plazo" id="i2_p7_plazo" class="c-form-input i2_p7 <?php echo @$datos['i2_p7_check']=="NO"?@$datos['clase']:''?>">
                    <?php echo $datos['i2_p7_plazo_options']?>
                </select>
            </fieldset>
        </div>
        <div class="break">
            <fieldset>
                <label class="c-form-label negrita" for="i2_p8_check">¿Puede entregar y/o suministrar productos y/o servicios a nivel nacional?<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="radio" name="i2_p8_check" id="i2_p8_check" value="SI" <?php echo @$datos['i2_p8_check']=="SI"?'checked':''?>>SI</label>
                <label class="alt_label c-form-label"><input type="radio" name="i2_p8_check" id="i2_p8_check" value="NO" <?php echo @$datos['i2_p8_check']=="NO"?'checked':''?>>NO</label><br/>                  
            </fieldset>
            </div>
            <div class="break">
            <fieldset>
                <label class="c-form-label negrita" for="i2_p9_check">¿Ofrece servicios postventa?<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="radio" name="i2_p9_check" id="i2_p9_check" value="SI" <?php echo @$datos['i2_p9_check']=="SI"?'checked':''?>>SI</label>
                <label class="alt_label c-form-label"><input type="radio" name="i2_p9_check" id="i2_p9_check" value="NO" <?php echo @$datos['i2_p9_check']=="NO"?'checked':''?>>NO</label><br/>                  
            </fieldset>                
            <fieldset class="i2_p9 <?php echo @$datos['i2_p9_check']=="NO"?@$datos['clase']:''?>">
                <label class="c-form-label negrita " for="i2_p9_postventa">Servicios<span class="c-form-required"> *</span></label><br/>
                <label class="alt_label c-form-label"><input type="checkbox" id="i2_p9_postventa" name="i2_p9_postventa[]" value="garantia" <?php echo strpos($datos['i2_p9_postventa'],'garantia')!==FALSE?'checked':''?>>Garantias</label>
                <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa[]" value="asesoria" <?php echo strpos($datos['i2_p9_postventa'],'asesoria')!==FALSE?'checked':''?>>Asesoria</label>
                <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa[]" value="asistencia tecnica" <?php echo strpos($datos['i2_p9_postventa'],'asistencia tecnica')!==FALSE?'checked':''?>>Asistencia Técnica</label>
                <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa[]" value="devolucion" <?php echo strpos($datos['i2_p9_postventa'],'devolucion')!==FALSE?'checked':''?>>Devolución</label>
            </fieldset>
        </div>              
    </div>
</div>
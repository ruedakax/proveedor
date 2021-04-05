<!-- I N I C I O  -  C A B E C E R A   I N F O R M A C I O N   COMERCIAL-->
<div class="form-box panel_2"><h3>2. Información Comercial<i class="arrow up"></i></h3></div>
<div class="form-box panel_2" id="panel_2">
    <div class="c-form">
        <div>
            <fieldset>
                <label class="c-form-label negrita" for="nombre_juridica">Tipo Actividad<span class="c-form-required"> *</span></label><br/>
                <input id="cuenta_banco" class="c-form-input" type="text" name="cuenta_banco" placeholder="Nombre Banco" value="<?=@$datos['tipo_actividad']?>" readonly>                
            </fieldset> 
        </div>
        <div>
            <fieldset>
                <label class="c-form-label negrita" for="nombre_juridica">Número de Empleados<span class="c-form-required"> *</span></label><br/>
                <input id="cuenta_banco" class="c-form-input" type="text" name="cuenta_banco" placeholder="Nombre Banco" value="<?=@$datos['nro_empleados']?>" readonly>
            </fieldset> 
        </div>
        <div class="two-columns">
            <fieldset>
                <label class="c-form-label negrita" for="regimen">Regimen<span class="c-form-required"> *</span></label><br/>
                <input id="cuenta_banco" class="c-form-input" type="text" name="cuenta_banco" placeholder="Nombre Banco" value="<?=@$datos['regimen']?>" readonly>                
            </fieldset>  
        </div>
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita" for="cuenta_banco">Nombre de entidad Bancaria<span class="c-form-required"> *</span></label>
                <input id="cuenta_banco" class="c-form-input" type="text" name="cuenta_banco" placeholder="Nombre Banco" value="<?=@$datos['cuenta_banco']?>" readonly>
            </fieldset>              
            <fieldset>
                <label class="c-form-label negrita" for="cuenta">No. Cuenta<span class="c-form-required"> *</span></label>
                <input id="cuenta" class="c-form-input" type="text" name="cuenta" placeholder="Número de cuenta" value="<?=@$datos['cuenta']?>" readonly>
            </fieldset> 
            <fieldset>
                <label class="c-form-label negrita" for="regimen">Tipo cuenta<span class="c-form-required"> *</span></label><br/>
                <input id="cuenta" class="c-form-input" type="text" name="cuenta" placeholder="Número de cuenta" value="<?=@$datos['cuenta_tipo']?>" readonly>                
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
                            <input id="refban_banco_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_banco_<?php echo ($key)?>" placeholder="Banco" value="<?php echo $value['banco']?>" readonly>
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_sucursal_<?php echo ($key)?>">Sucursal<span class="c-form-required"> *</span></label>
                            <input id="refban_sucursal_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_sucursal_<?php echo ($key)?>" placeholder="Sucursal" value="<?php echo $value['sucursal']?>" readonly>
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_cuenta_<?php echo ($key)?>">Nro. Cuenta<span class="c-form-required"> *</span></label>
                            <input id="refban_cuenta_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_cuenta_<?php echo ($key)?>" placeholder="Número de cuenta" value="<?php echo $value['cuenta']?>" readonly>
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_telefono_<?php echo ($key)?>">Teléfono<span class="c-form-required"> *</span></label>
                            <input id="refban_telefono_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_telefono_<?php echo ($key)?>" placeholder="Teléfono" value="<?php echo $value['telefono']?>" readonly> 
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_contacto_<?php echo ($key)?>">Persona Contacto<span class="c-form-required"> *</span></label>
                            <input id="refban_contacto_<?php echo ($key)?>" class="c-form-input" type="text" name="refban_contacto_<?php echo ($key)?>" placeholder="Nombre del contacto" value="<?php echo $value['contacto']?>" readonly>
                        </fieldset>
                    </div>
                </div>
                <?php 
                } 
                //fin refBancarias
                ?>
            </div>                            
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
                            <input id="refcom_empresa_<?php echo ($key)?>" class="c-form-input" type="text" name="refcom_empresa_<?php echo ($key)?>" placeholder="Banco" value="<?php echo $value['empresa']?>" readonly>
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refcom_contacto_<?php echo ($key)?>">Contacto<span class="c-form-required"> *</span></label>
                            <input id="refcom_contacto_<?php echo ($key)?>" class="c-form-input" type="text" name="refcom_contacto_<?php echo ($key)?>" placeholder="Sucursal" value="<?php echo $value['contacto']?>" readonly> 
                        </fieldset>
                        <fieldset>
                            <label class="c-form-label negrita" for="refban_cuenta_<?php echo ($key)?>">Cupos<span class="c-form-required"> *</span></label>
                            <input id="refcom_cupos_<?php echo ($key)?>" class="c-form-input" type="text" name="refcom_cupos_<?php echo ($key)?>" placeholder="Cupos" value="<?php echo $value['cupos']?>" readonly>
                        </fieldset>
                    </div>
                </div>
                <?php 
                } 
                //fin refBancarias
                ?>
            </div>                   
        </div>
        <div class="break">
            <fieldset>
                <label class="c-form-label negrita" for="i2_p6_check">¿Suministra productos y/o servicios a otros clientes similares a nuestra empresa?<span class="c-form-required"> *</span></label><br/>
                <input class="c-form-input" type="text" placeholder="Cupos" value="<?php echo $datos['i2_p6_check']?>" readonly>
                <label class="c-form-label negrita i2_p6 <?php echo @$datos['i2_p6_check']=="NO"?@$datos['clase']:''?>" for="i2_p6_empresas">¿Cuáles Empresas?<span class="c-form-required"> *</span></label>
                <input id="i2_p6_empresas" class="c-form-input i2_p6 <?php echo @$datos['i2_p6_check']=="NO"?@$datos['clase']:''?>" type="text" name="i2_p6_empresas" placeholder="Empresas" value="<?=@$datos['i2_p6_empresas']?>" readonly>
            </fieldset>
        </div>              
        <div class="break">
            <fieldset>
                <label class="c-form-label negrita" for="i2_p7_check">¿Ofrece créditos para pago?<span class="c-form-required"> *</span></label><br/>
                <input id="i2_p6_empresas" class="c-form-input" type="text" name="i2_p6_empresas" placeholder="Empresas" value="<?=@$datos['i2_p7_check']?>" readonly>                
                <label class="c-form-label negrita i2_p7 <?php echo @$datos['i2_p7_check']=="NO"?@$datos['clase']:''?>" for="i2_p7_plazo">Plazo<span class="c-form-required"> *</span></label>
                <select name="i2_p7_plazo" id="i2_p7_plazo" class="c-form-input i2_p7 <?php echo @$datos['i2_p7_check']=="NO"?@$datos['clase']:''?>" disabled>
                    <?php echo $datos['i2_p7_plazo_options']?>
                </select>
            </fieldset>
        </div>
        <div class="break">
            <fieldset>
                <label class="c-form-label negrita" for="i2_p8_check">¿Puede entregar y/o suministrar productos y/o servicios a nivel nacional?<span class="c-form-required"> *</span></label><br/>
                <input id="i2_p6_empresas" class="c-form-input" type="text" name="i2_p6_empresas" placeholder="Empresas" value="<?=@$datos['i2_p8_check']?>" readonly>                                
            </fieldset>
            </div>
            <div class="break">
            <fieldset>
                <label class="c-form-label negrita" for="i2_p9_check">¿Ofrece servicios postventa?<span class="c-form-required"> *</span></label><br/>
                <input id="i2_p6_empresas" class="c-form-input" type="text" name="i2_p6_empresas" placeholder="Empresas" value="<?=@$datos['i2_p9_check']?>" readonly>                
            </fieldset>                
            <fieldset class="i2_p9 <?php echo @$datos['i2_p9_check']=="NO"?@$datos['clase']:''?>">            
                <label class="c-form-label negrita " for="i2_p9_postventa">Servicios<span class="c-form-required"> *</span></label><br/>                
                <label class="alt_label c-form-label"><input type="checkbox" id="i2_p9_postventa" name="i2_p9_postventa[]" value="garantia" <?php echo strpos($datos['i2_p9_postventa'],'garantia')!==FALSE?'checked':''?> disabled>Garantias</label>
                <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa[]" value="asesoria" <?php echo strpos($datos['i2_p9_postventa'],'asesoria')!==FALSE?'checked':''?> disabled>Asesoria</label>
                <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa[]" value="asistencia tecnica" <?php echo strpos($datos['i2_p9_postventa'],'asistencia tecnica')!==FALSE?'checked':''?> disabled>Asistencia Técnica</label>
                <label class="alt_label c-form-label"><input type="checkbox" name="i2_p9_postventa[]" value="devolucion" <?php echo strpos($datos['i2_p9_postventa'],'devolucion')!==FALSE?'checked':''?> disabled>Devolución</label>
            </fieldset>
        </div>              
    </div>
</div>
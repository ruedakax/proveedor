<div class="form-box panel_1"><h3>1. Información General<i class="arrow down"></i></h3></div>
<div class="form-box panel_1" id="panel_1">
    <div class="c-form">
        <div class="two-columns">
            <fieldset>
            <label class="c-form-label negrita" for="nombre">Nombre &oacute; Raz&oacute;n Social<span class="c-form-required"> *</span></label>
            <input id="nombre" class="c-form-input" type="text" name="nombre" placeholder="Nombre" value="<?=@$datos['nombre']?>">
            </fieldset>
            <fieldset>
            <label class="c-form-label negrita" for="nit">NIT/CC<span class="c-form-required"> *</span></label>
            <input id="nit" class="c-form-input" type="text" name="nit" placeholder="Nit/CC" value="<?=@$datos['nit']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="tipo_persona">Tipo Persona<span class="c-form-required"> *</span></label>
                <select name="tipo_persona" id="tipo_persona" class="c-form-input">
                    <?php echo $datos['tipo_persona_options']?>
                </select>
            </fieldset>
        </div>          
        <div class="two-columns item-sucursal <?php echo @$datos['tipo_persona']=="juridica"?'':@$datos['clase'];?>" id="juridica">
            <fieldset>
            <label class="c-form-label negrita" for="nombre_juridica">Nombre Representante Legal<span class="c-form-required"> *</span></label>
            <input id="rep_legal" class="c-form-input" type="text" name="rep_legal" placeholder="Nombre" value="<?=@$datos['rep_legal']?>">
            </fieldset>
            <fieldset>
            <label class="c-form-label negrita" for="rep_documento">Documento<span class="c-form-required"> *</span></label>
            <input id="rep_documento" class="c-form-input" type="text" name="rep_documento" placeholder="Documento" value="<?=@$datos['rep_documento']?>">
            </fieldset>
            <fieldset>
            <label class="c-form-label negrita" for="rep_email">Email<span class="c-form-required"> *</span></label>
            <input id="rep_email" class="c-form-input" type="text" name="rep_email" placeholder="Email" value="<?=@$datos['rep_email']?>">
            </fieldset>
        </div>
        <fieldset>
            <label class="c-form-label negrita" for="tipo_sociedad">Tipo Sociedad<span class="c-form-required"> *</span></label><br/>
            <label class="alt_label c-form-label"><input type="radio" name="tipo_sociedad" value="privada" <?php echo @$datos['tipo_sociedad']=="privada"?'checked':''?>>Privada</label>
            <label class="alt_label c-form-label"><input type="radio" name="tipo_sociedad" value="publica" <?php echo @$datos['tipo_sociedad']=="publica"?'checked':''?>>Pública</label>
            <label class="alt_label c-form-label"><input type="radio" name="tipo_sociedad" value="mixta" <?php echo @$datos['tipo_sociedad']=="mixta"?'checked':''?>>Mixta</label>
            <label class="alt_label c-form-label"><input type="radio" name="tipo_sociedad" value="ESAL" <?php echo @$datos['tipo_sociedad']=="ESAL"?'checked':''?>>Entidad Sin Ánimo de Lucro</label>
        </fieldset>            
        <div class="two-columns">
            <fieldset>
                <label class="c-form-label negrita" for="contacto_nombre">Contacto<span class="c-form-required"> *</span></label>
                <input id="contacto_nombre" class="c-form-input" type="text" name="contacto_nombre" placeholder="Nombre Completo del Contacto" value="<?=@$datos['contacto_nombre']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="contacto_celular">Celular<span class="c-form-required"> *</span></label>
                <input id="contacto_celular" class="c-form-input" type="text" name="contacto_celular" placeholder="Número Celular" value="<?=@$datos['contacto_celular']?>">
            </fieldset>              
        </div>
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita" for="contacto_email">Email<span class="c-form-required"> *</span></label>
                <input id="contacto_email" class="c-form-input" type="text" name="contacto_email" placeholder="email" value="<?=@$datos['contacto_email']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="contacto_site">Página Web<span class="c-form-required"> *</span></label>
                <input id="contacto_site" class="c-form-input" type="text" name="contacto_site" placeholder="Página Web" value="<?=@$datos['contacto_site']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="contacto_telefono">Teléfono<span class="c-form-required"> *</span></label>
                <input id="contacto_telefono" class="c-form-input" type="text" name="contacto_telefono" placeholder="Télefono" value="<?=@$datos['contacto_telefono']?>">
            </fieldset>
        </div>
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita" for="direccion">Dirección Oficina Principal<span class="c-form-required"> *</span></label>
                <input id="direccion" class="c-form-input" type="text" name="direccion" placeholder="Dirección" value="<?=@$datos['direccion']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="pais">País<span class="c-form-required"> *</span></label>
                <input id="pais" class="c-form-input" type="text" name="pais" placeholder="País" value="<?=@$datos['pais']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="ciudad">Ciudad<span class="c-form-required"> *</span></label>
                <input id="ciudad" class="c-form-input" type="text" name="ciudad" placeholder="Ciudad" value="<?=@$datos['ciudad']?>">
            </fieldset>
        </div>
        <fieldset>
            <label class="c-form-label negrita" for="sucursales">Posee Sucursales<span class="c-form-required">*</span></label><br/>
            <label class="alt_label c-form-label"><input type="radio" name="sucursales" class="checkSucursales" value="SI" <?php echo @$datos['sucursales']=="SI"?'checked':''?>>SÍ</label>
            <label class="alt_label c-form-label"><input type="radio" name="sucursales" class="checkSucursales" value="NO" <?php echo @$datos['sucursales']=="NO"?'checked':''?>>NO</label>
            <button class="myButton areaSucursales <?php echo @$datos['sucursales']=="NO"?@$datos['clase']:''?>" type="button" id="agregarBtn">Agregar</button>
            <div id="areaSucursales" class="areaSucursales <?php echo @$datos['sucursales']=="NO"?@$datos['clase']:''?>">
            <?php
                //inicio sucursales
                foreach ($datos['list_sucursales'] as $key => $value) {
            ?>
            <div>
                <div class='close'><span class="x">x</span></div>
                <div class="three-columns item-sucursal">
                    <fieldset> 
                        <input id="dir_suc_<?php echo $key?>" class="c-form-input" type="text" name="dir_suc_<?php echo $key?>" placeholder="Dirección" value="<?php echo $value['direccion']?>">
                    </fieldset>
                    <fieldset>
                        <input id="pais_suc_<?php echo $key?>" class="c-form-input" type="text" name="pais_suc_<?php echo $key?>" placeholder="País" value="<?php echo $value['pais']?>">
                    </fieldset>
                    <fieldset>
                        <input id="ciudad_suc_<?php echo $key?>" class="c-form-input" type="text" name="ciudad_suc_<?php echo $key?>" placeholder="Ciudad" value="<?php echo $value['ciudad']?>">
                    </fieldset>
                </div>
            </div>        
            <?php 
                } 
                //fin sucursales
            ?>
            </div>
        </fieldset>
        <div class="two-columns">
            <fieldset>
                <label class="c-form-label negrita" for="reg_mercantil">No. Registro Mercantil<span class="c-form-required"> *</span></label>
                <input id="reg_mercantil" class="c-form-input" type="text" name="reg_mercantil" placeholder="Digite el número" value="<?=@$datos['reg_mercantil']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="reg_fecha" class="c-form-input" type="text" name="reg_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['reg_fecha']?>">
            </fieldset>              
        </div>            
        <div class="four-columns">
            <fieldset>
                <label class="c-form-label negrita" for="escritura_num">No. Escritura<span class="c-form-required"> *</span></label>
                <input id="escritura_num" class="c-form-input" type="text" name="escritura_num" placeholder="Digite el número" value="<?=@$datos['escritura_num']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="escritura_fecha">Fecha<span class="c-form-required"> *</span></label>
                <input id="escritura_fecha" class="c-form-input" type="text" name="escritura_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['escritura_fecha']?>">
            </fieldset>              
            <fieldset>
                <label class="c-form-label negrita" for="escritura_notaria">Notaria<span class="c-form-required"> *</span></label>
                <input id="escritura_notaria" class="c-form-input" type="text" name="escritura_notaria" placeholder="Digite el número" value="<?=@$datos['escritura_notaria']?>">
            </fieldset>
            <fieldset>
                <label class="c-form-label negrita" for="escritura_ciudad">Ciudad<span class="c-form-required"> *</span></label>
                <input id="escritura_ciudad" class="c-form-input" type="text" name="escritura_ciudad" placeholder="Ciudad" value="<?=@$datos['escritura_ciudad']?>">
            </fieldset>              
        </div>
        <div class="two-columns">
            <fieldset>
            <label class="c-form-label negrita" for="autoretenedor">Autoretenedor<span class="c-form-required"> *</span></label><br/>
            <label class="alt_label c-form-label"><input type="radio" name="autoretenedor" id="autoretenedor" value="SI" <?php echo @$datos['autoretenedor']=="SI"?'checked':''?>>SÍ</label>
            <label class="alt_label c-form-label"><input type="radio" name="autoretenedor" id="autoretenedor" value="NO" <?php echo @$datos['autoretenedor']=="NO"?'checked':''?>>NO</label>
            </fieldset>
            <fieldset class="autoretenedor item-sucursal <?php echo @$datos['autoretenedor']=="NO"?@$datos['clase']:''?>">
                <label class="c-form-label negrita" for="retenedor_res">No. Resoluci&oacute;n<span class="c-form-required"> *</span></label>
                <input id="retenedor_res" class="c-form-input" type="text" name="retenedor_res" placeholder="No. Resolución" value="<?=@$datos['retenedor_res']?>">
            </fieldset>              
        </div>            
    </div>
</div>
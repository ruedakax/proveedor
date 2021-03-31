<?php
$oculto_gestion;
$oculto_sin_gestion;
if($datos['i3_p1_check'] === 'NO' && $datos['tipoPersona'] ==='juridica'){
  $oculto_gestion ='';
  $oculto_sin_gestion ='';
}elseif($datos['i3_p1_check'] === 'SI' && $datos['tipoPersona'] ==='juridica'){
  $oculto_sin_gestion =$datos['clase'];  
}else{
  $oculto_gestion = $datos['clase'];    
}
?>
<!-- INCIO -  C A B E C E R A   I N F O R M A C I O N   S I S T E M A S   G E S T I O N-->
<div class="form-box panel_3"><h3>3. Información de Sistemas de Gestión<i class="arrow down"></i></h3></div>
<div class="form-box panel_1 pequena  item-sucursal">&nbsp;* Oprima el botón&nbsp;<i>Siguiente</i>&nbsp; de la parte inferior para guardar la información del presente formulario y continuar con el proceso</div>
<div class="form-box panel_3" id="panel_3">
  <div class="c-form">
    <div class="break">
      <fieldset id="conGestion" class="<?php echo $oculto_gestion?>">
        <label class="c-form-label negrita" for="i3_p1_check">¿Posee certificado de Sistema de Gestión?<span class="c-form-required"> *</span></label><br/>
        <label class="alt_label c-form-label"><input type="radio" name="i3_p1_check" id="i3_p1_check" value="SI" <?php echo @$datos['i3_p1_check']=="SI"?'checked':''?>>SI</label>
        <label class="alt_label c-form-label"><input type="radio" name="i3_p1_check" id="i3_p1_check" value="NO" <?php echo @$datos['i3_p1_check']=="NO"?'checked':''?>>NO</label><br/>
      </fieldset>
      <fieldset class="i3_p1 <?php echo @$datos['i3_p1_check']=="NO"?@$datos['clase']:''?>">
        <label class="c-form-label negrita" for="i3_p1_certificado">Certificados<span class="c-form-required"> *</span></label><br/>
        <label class="alt_label c-form-label"><input type="checkbox" class="certi" id="i3_p1_certificados" name="i3_p1_certificados[]" value="calidad" <?php echo strpos($datos['i3_p1_certificados'],'calidad')!==FALSE?'checked':''?>>Calidad</label>
        <label class="alt_label c-form-label"><input type="checkbox" class="certi" name="i3_p1_certificados[]" value="SST" <?php echo strpos($datos['i3_p1_certificados'],'SST')!==FALSE?'checked':''?>>Seguridad y Salud en el Trabajo</label>
        <label class="alt_label c-form-label"><input type="checkbox" class="certi" name="i3_p1_certificados[]" value="ambiental" <?php echo strpos($datos['i3_p1_certificados'],'ambiental')!==FALSE?'checked':''?>>Ambiental</label>
        <label class="alt_label c-form-label"><input type="checkbox" class="certi" name="i3_p1_certificados[]" value="enCertificacion" <?php echo strpos($datos['i3_p1_certificados'],'enCertificacion')!==FALSE?'checked':''?>>En Certificación</label><br/>
        <label class="c-form-label negrita" for="i3_p1_ec_asesora">Si La respuesta es <i>"En Certificacion"</i>, ingrese la firma asesora<span class="c-form-required"> *</span></label>
        <input id="i3_p1_ec_asesora" class="c-form-input" type="text" name="i3_p1_ec_asesora" placeholder="firma asesora" value="<?=@$datos['i3_p1_ec_asesora']?>">
      </fieldset>
    </div>
    <div id="sinGestion" class="<?php echo $oculto_sin_gestion?>">
      <fieldset>
        <label class="c-form-label negrita item-sucursal" for="sucursales">SOLO  PARA PRODUCTORES, DISTRIBUIDORES O PRESTADORES DE SERVICIOS</label><br/>
      </fieldset>
      <div class="break">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p1_check">¿Posee controles de calidad?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p1_check" id="gi3_p1_check" value="SI" <?php echo @$datos['gi3_p1_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p1_check" id="gi3_p1_check" value="NO" <?php echo @$datos['gi3_p1_check']=="NO"?'checked':''?>>NO</label><br/>
          <label class="c-form-label negrita gi3_p1 <?php echo @$datos['gi3_p1_check']=="NO"?@$datos['clase']:''?>" for="gi3_p1_control_calidad">¿De qué tipo?<span class="c-form-required"> *</span></label>
          <input id="gi3_p1_control_calidad" class="c-form-input gi3_p1 <?php echo @$datos['gi3_p1_check']=="NO"?@$datos['clase']:''?>" type="text" name="gi3_p1_control_calidad" placeholder="" value="<?=@$datos['gi3_p1_control_calidad']?>">
        </fieldset>
      </div>   
      <div class="break">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p2_check">¿Poseen su productos sellos de calidad?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p2_check" id="gi3_p2_check" value="SI" <?php echo @$datos['gi3_p2_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p2_check" id="gi3_p2_check" value="NO" <?php echo @$datos['gi3_p2_check']=="NO"?'checked':''?>>NO</label><br/>
          <label class="c-form-label negrita gi3_p2 <?php echo @$datos['gi3_p2_check']=="NO"?@$datos['clase']:''?>" for="gi3_p2_sellos">Mencione productos y normas<span class="c-form-required"> *</span></label>
          <input id="gi3_p2_sellos" class="c-form-input gi3_p2 <?php echo @$datos['gi3_p2_check']=="NO"?@$datos['clase']:''?>" type="text" name="gi3_p2_sellos" placeholder="" value="<?=@$datos['gi3_p2_sellos']?>">
        </fieldset>
      </div> 
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p3_check">¿Cuenta con personal capacitado y calificado para la prestación de sus servicios?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p3_check" id="gi3_p3_check" value="SI" <?php echo @$datos['gi3_p3_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p3_check" id="gi3_p3_check" value="NO" <?php echo @$datos['gi3_p3_check']=="NO"?'checked':''?>>NO</label><br/>                    
        </fieldset>                
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p4_check">¿Verifica las materias primas que requieren sus servicios?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p4_check" id="gi3_p4_check" value="SI" <?php echo @$datos['gi3_p4_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p4_check" id="gi3_p4_check" value="NO" <?php echo @$datos['gi3_p4_check']=="NO"?'checked':''?>>NO</label><br/>
        </fieldset>
      </div> 
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p5_check">¿Posee certificados de los trabajos realizados a otros clientes?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p5_check" id="gi3_p5_check" value="SI" <?php echo @$datos['gi3_p5_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p5_check" id="gi3_p5_check" value="NO" <?php echo @$datos['gi3_p5_check']=="NO"?'checked':''?>>NO</label><br/>
        </fieldset>                
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p6_check">¿Cuenta con procedimientos escritos de los procesos involucrados en sus servicios?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p6_check" id="gi3_p6_check" value="SI" <?php echo @$datos['gi3_p6_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p6_check" id="gi3_p6_check" value="NO" <?php echo @$datos['gi3_p6_check']=="NO"?'checked':''?>>NO</label><br/>
        </fieldset>
      </div> 
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p7_check">¿Cuenta con procedimientos de control de productos no conforme?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p7_check" id="gi3_p7_check" value="SI" <?php echo @$datos['gi3_p7_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p7_check" id="gi3_p7_check" value="NO" <?php echo @$datos['gi3_p7_check']=="NO"?'checked':''?>>NO</label><br/>
        </fieldset>                
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p8_check">¿Cuenta con condiciones de almacenamiento que garantizan la calidad del producto?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p8_check" id="gi3_p8_check" value="SI" <?php echo @$datos['gi3_p8_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p8_check" id="gi3_p8_check" value="NO" <?php echo @$datos['gi3_p8_check']=="NO"?'checked':''?>>NO</label><br/>
        </fieldset>
      </div> 
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p9_check">¿El empaque de su producto facilita su identificación (fecha, lote)?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p9_check" id="gi3_p9_check" value="SI" <?php echo @$datos['gi3_p9_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p9_check" id="gi3_p9_check" value="NO" <?php echo @$datos['gi3_p9_check']=="NO"?'checked':''?>>NO</label><br/>                    
        </fieldset>                
        <fieldset>
          <label class="c-form-label negrita" for="gi3_p10_check">¿Realiza una adecuada gestión de los residuos que genera, conforme a la legislación vigente?<span class="c-form-required"> *</span></label><br/>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p10_check" id="gi3_p10_check" value="SI" <?php echo @$datos['gi3_p10_check']=="SI"?'checked':''?>>SI</label>
          <label class="alt_label c-form-label"><input type="radio" name="gi3_p10_check" id="gi3_p10_check" value="NO" <?php echo @$datos['gi3_p10_check']=="NO"?'checked':''?>>NO</label><br/>
        </fieldset>
      </div> 
    </div>
  </div>
</div>
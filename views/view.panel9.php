<!-- INCIO -  C A B E C E R A   I N F O R M A C I O N-->
<div class="form-box panel_8"><h3>ANEXOS<i class="arrow down"></i></h3></div>
<div class="form-box panel_1 pequena  item-sucursal error"><p>&nbsp;*Cada anexo se guarda de manera individual y puede ser modificado cuantas veces sea necesario.  Una vez haya anexado los documentos según su criterio, oprima el botón Finalizar para dar inicio a la revisión del registro por parte de SP Ingenieros.</p></div>
<div class="form-box panel_8 " id="panel_8">
    <div class="c-form">
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Cédula del representante legal y/o persona natural<span class="c-form-required"> *</span></label><br/>
                <input id="file_cedula" class="c-form-input" type="file" name="file_cedula" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cedula">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cedula']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cedula">
                    <?php                         
                        echo isset($datos['file_cedula']['nit'])?'<span class="view" data-url="'.$datos['file_cedula']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado de existencia y representación legal (fecha expedición no superior a 60 días)<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_existencia" class="c-form-input" type="file" name="file_cert_existencia" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_existencia">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_existencia']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_existencia">
                    <?php                         
                        echo isset($datos['file_cert_existencia']['nit'])?'<span class="view" data-url="'.$datos['file_cert_existencia']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php if($tipoPersona=="natural"){?>
        <!--DOC-->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Registro Mercantil<span class="c-form-required"> *</span></label><br/>
                <input id="file_reg_mercantil" class="c-form-input" type="file" name="file_reg_mercantil" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_reg_mercantil">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_reg_mercantil']['nit'])?'status-saved':'status-nofile'?>" id="status_file_reg_mercantil">
                    <?php                         
                        echo isset($datos['file_reg_mercantil']['nit'])?'<span class="view" data-url="'.$datos['file_reg_mercantil']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>                                
        <?php }?>
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">RUT<span class="c-form-required"> *</span></label><br/>
                <input id="file_rut" class="c-form-input" type="file" name="file_rut" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_rut">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_rut']['nit'])?'status-saved':'status-nofile'?>" id="status_file_rut">
                    <?php                         
                        echo isset($datos['file_rut']['nit'])?'<span class="view" data-url="'.$datos['file_rut']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>                
        <?php if($tipoPersona=="natural"){?>
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificación bancaria vigente<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_bancaria" class="c-form-input" type="file" name="file_cert_bancaria" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_bancaria">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_bancaria']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_bancaria">
                    <?php                         
                        echo isset($datos['file_cert_bancaria']['nit'])?'<span class="view" data-url="'.$datos['file_cert_bancaria']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>                
        <?php }?>
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Estados financieros (2 últimos años, auditados y firmados)<span class="c-form-required"> *</span></label><br/>
                <input id="file_estado_financiero" class="c-form-input" type="file" name="file_estado_financiero" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_estado_financiero">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_estado_financiero']['nit'])?'status-saved':'status-nofile'?>" id="status_file_estado_financiero">
                    <?php                         
                        echo isset($datos['file_estado_financiero']['nit'])?'<span class="view" data-url="'.$datos['file_estado_financiero']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php if($general['i5_p1_check']=="SI"){?>
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificación cumpliento Ley 1778 (firmada por representante legal o revisor fiscal)<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_1778" class="c-form-input" type="file" name="file_cert_1778" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_1778">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_1778']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_1778">
                    <?php                         
                        echo isset($datos['file_cert_1778']['nit'])?'<span class="view" data-url="'.$datos['file_cert_1778']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php }?>
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado da tradición y libertad. (arrendamientos) a 30 días.<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_tradi_liber" class="c-form-input" type="file" name="file_cert_tradi_liber" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_tradi_liber">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_tradi_liber']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_tradi_liber">
                    <?php                         
                        echo isset($datos['file_cert_tradi_liber']['nit'])?'<span class="view" data-url="'.$datos['file_cert_tradi_liber']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php if($tipoRegistro!="cliente"){?>
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado de la ARL, donde mencione implementacion del SG SST, Decreto 1072 de 2015<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_arl" class="c-form-input" type="file" name="file_cert_arl" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_arl">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_arl']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_arl">
                    <?php                         
                        echo isset($datos['file_cert_arl']['nit'])?'<span class="view" data-url="'.$datos['file_cert_arl']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php }?>
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Documentos equivalentes de identificación internacional. (Cédula de extrajería, pasaporte)<span class="c-form-required"> *</span></label><br/>
                <input id="file_doc_internacional" class="c-form-input" type="file" name="file_doc_internacional" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_doc_internacional">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_doc_internacional']['nit'])?'status-saved':'status-nofile'?>" id="status_file_doc_internacional">
                    <?php                         
                        echo isset($datos['file_doc_internacional']['nit'])?'<span class="view" data-url="'.$datos['file_doc_internacional']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>        
        <!--DOC -->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificación de cumplimiento de las normas de lavado de activos y finaciación del terrorismo<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_laft" class="c-form-input" type="file" name="file_cert_laft" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_laft">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_laft']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_laft">
                    <?php                         
                        echo isset($datos['file_cert_laft']['nit'])?'<span class="view" data-url="'.$datos['file_cert_laft']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php if($tipoRegistro!="cliente" && $tipoPersona=="natural"){?>
        <!--DOC SOLO PERONAS NATURALES-->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado de afiliación a salud<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_eps" class="c-form-input" type="file" name="file_cert_eps" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_eps">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_eps']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_eps">
                    <?php                         
                        echo isset($datos['file_cert_eps']['nit'])?'<span class="view" data-url="'.$datos['file_cert_eps']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC SOLO PERONAS NATURALES-->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado de afiliación a salud<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_pension" class="c-form-input" type="file" name="file_cert_pension" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_pension">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_pension']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_pension">
                    <?php                         
                        echo isset($datos['file_cert_pension']['nit'])?'<span class="view" data-url="'.$datos['file_cert_pension']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC SOLO PERONAS NATURALES-->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado de afiliación a pensión<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_pension" class="c-form-input" type="file" name="file_cert_pension" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_pension">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_pension']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_pension">
                    <?php                         
                        echo isset($datos['file_cert_pension']['nit'])?'<span class="view" data-url="'.$datos['file_cert_pension']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC SOLO PERONAS NATURALES-->                
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado de afiliación a riesgos laborales - ARL<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_arl" class="c-form-input" type="file" name="file_cert_arl" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_arl">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_arl']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_arl">
                    <?php                         
                        echo isset($datos['file_cert_arl']['nit'])?'<span class="view" data-url="'.$datos['file_cert_arl']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC SOLO PERONAS NATURALES-->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado de afiliación a cajas de compensación<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_cajacomp" class="c-form-input" type="file" name="file_cert_cajacomp" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_cajacomp">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_cajacomp']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_cajacomp">
                    <?php                         
                        echo isset($datos['file_cert_cajacomp']['nit'])?'<span class="view" data-url="'.$datos['file_cert_cajacomp']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>        
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Registro Único de Afiliaciones RUAF<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_ruaf" class="c-form-input" type="file" name="file_cert_ruaf" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_ruaf">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_ruaf']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_ruaf">
                    <?php                         
                        echo isset($datos['file_cert_ruaf']['nit'])?'<span class="view" data-url="'.$datos['file_cert_ruaf']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php if(strpos($datos['i3_p1_certificados'],'calidad')!==FALSE){?>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado gestión calidad<span class="c-form-required"> *</span></label><br/>
                <input id="file_certges_calidad" class="c-form-input" type="file" name="file_certges_calidad" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_certges_calidad">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_certges_calidad']['nit'])?'status-saved':'status-nofile'?>" id="status_file_certges_calidad">
                    <?php                         
                        echo isset($datos['file_certges_calidad']['nit'])?'<span class="view" data-url="'.$datos['file_certges_calidad']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php } ?>
        <?php if(strpos($datos['i3_p1_certificados'],'ambiental')!==FALSE){?>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado gestión ambiental<span class="c-form-required"> *</span></label><br/>
                <input id="file_certges_ambiental" class="c-form-input" type="file" name="file_certges_ambiental" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_certges_ambiental">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_certges_ambiental']['nit'])?'status-saved':'status-nofile'?>" id="status_file_certges_ambiental">
                    <?php                         
                        echo isset($datos['file_certges_ambiental']['nit'])?'<span class="view" data-url="'.$datos['file_certges_ambiental']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php } ?>
        <?php if(strpos($datos['i3_p1_certificados'],'SST')!==FALSE){ ?>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado gestión SST<span class="c-form-required"> *</span></label><br/>
                <input id="file_certges_sst" class="c-form-input" type="file" name="file_certges_sst" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_certges_sst">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_certges_sst']['nit'])?'status-saved':'status-nofile'?>" id="status_file_certges_sst">
                    <?php                         
                        echo isset($datos['file_certges_sst']['nit'])?'<span class="view" data-url="'.$datos['file_certges_sst']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php } ?>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">Certificado de importación OEA<span class="c-form-required"> *</span></label><br/>
                <input id="file_cert_importacion" class="c-form-input" type="file" name="file_cert_importacion" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cert_importacion">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cert_importacion']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cert_importacion">
                    <?php                         
                        echo isset($datos['file_cert_importacion']['nit'])?'<span class="view" data-url="'.$datos['file_cert_importacion']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <?php }//fin condicion personas naturales que no son clientes?>
    </div>
</div>
<div class="form-box panel_anexos_crititcos"><h3>INFORMACIÓN IMPORTANTE PARA PROVEEEDORES CRITICOS.<i class="arrow down"></i></h3></div>
<div class="form-box panel_1 pequena  item-sucursal">&nbsp;*Es requisito para su aprobación anexar copia de los siguientes documentos.</div>
<div class="form-box" id="panel_anexos_criticos">
    <div class="c-form">
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">MATERIAL DE PLAYA: El archivo debe incluir licencia ambiental, permiso de explotación y permiso minero. Certificado RUCOM, contrato de operación minera (si aplica), el PTO actualizado y aprobado por la autoridad minera.<span class="c-form-required"> *</span></label><br/>
                <input id="file_mat_playa" class="c-form-input" type="file" name="file_mat_playa" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_mat_playa">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_mat_playa']['nit'])?'status-saved':'status-nofile'?>" id="status_file_mat_playa">
                    <?php                         
                        echo isset($datos['file_mat_playa']['nit'])?'<span class="view" data-url="'.$datos['file_mat_playa']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">COMBUSTIBLE: El archivo debe incluir autorización del Ministerio de Minas y Energía, certificado de uso del suelo, certificado de cumplimiento de la sección 8 "Transporte terrestre automotor de mercancías peligrosas por carretera" del Decreto Único Reglamentario 1079 de 2015 del SectorTransporte, firmada por el representante legal.<span class="c-form-required"> *</span></label><br/>
                <input id="file_combustible" class="c-form-input" type="file" name="file_combustible" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_combustible">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_combustible']['nit'])?'status-saved':'status-nofile'?>" id="status_file_combustible">
                    <?php                         
                        echo isset($datos['file_combustible']['nit'])?'<span class="view" data-url="'.$datos['file_combustible']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">MEDICAMENTO: Licencia de funcionamiento vigente. <span class="c-form-required"> *</span></label><br/>
                <input id="file_medicamento" class="c-form-input" type="file" name="file_medicamento" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_medicamento">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_medicamento']['nit'])?'status-saved':'status-nofile'?>" id="status_file_medicamento">
                    <?php                         
                        echo isset($datos['file_medicamento']['nit'])?'<span class="view" data-url="'.$datos['file_medicamento']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">MADERA: El archivo debe incluir registro del ICA, donde se da autorización a la plantación comercial para explotar madera,  Licencia Ambiental expedida por la Autoridad Ambiental autorizando el aprovechamiento forestal de X especie, en X volumen y por X tiempo, Guía de movilización de la madera  (la especie árborea relacionada en la guía debe ser la misma que hemos solicitado y estar a nombre del Titular de la Licencia Ambiental (salvoconducto).<span class="c-form-required"> *</span></label><br/>
                <input id="file_madera" class="c-form-input" type="file" name="file_madera" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_madera">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_madera']['nit'])?'status-saved':'status-nofile'?>" id="status_file_madera">
                    <?php                         
                        echo isset($datos['file_madera']['nit'])?'<span class="view" data-url="'.$datos['file_madera']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">ALIMENTACION: carnet de manipulación de alimentos.<span class="c-form-required"> *</span></label><br/>
                <input id="file_alimentacion" class="c-form-input" type="file" name="file_alimentacion" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_alimentacion">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_alimentacion']['nit'])?'status-saved':'status-nofile'?>" id="status_file_alimentacion">
                    <?php                         
                        echo isset($datos['file_alimentacion']['nit'])?'<span class="view" data-url="'.$datos['file_alimentacion']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">AGUA: examen fisicoquimico que cumpla con la normatividad para consumo de agua potable por lote.<span class="c-form-required"> *</span></label><br/>
                <input id="file_agua" class="c-form-input" type="file" name="file_agua" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_agua">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_agua']['nit'])?'status-saved':'status-nofile'?>" id="status_file_agua">
                    <?php                         
                        echo isset($datos['file_agua']['nit'])?'<span class="view" data-url="'.$datos['file_agua']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">TRANSPORTE Y DISPOSICION FINAL DE RESIDUOS PELIGROSOS Y HOSPITALARIOS: El archivo debe incluir licencia para la disposicion final de cada uno de los procesos que realiza a los residuos sólidos peligrosos y certificado de cumplimiento de la sección 8 "Transporte terrestre automotor de mercancías peligrosas por carretera" del Decreto Único Reglamentario 1079 de 2015 del SectorTransporte, firmada por el representante legal.<span class="c-form-required"> *</span></label><br/>
                <input id="file_residuos" class="c-form-input" type="file" name="file_residuos" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_residuos">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_residuos']['nit'])?'status-saved':'status-nofile'?>" id="status_file_residuos">
                    <?php                         
                        echo isset($datos['file_residuos']['nit'])?'<span class="view" data-url="'.$datos['file_residuos']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">TRANSPORTE DE COMBUSTIBLE: El archivo debe incluir permiso de habilitación por el Ministerio de Transporte. Certificado de cumplimiento de la sección 8 "Transporte terrestre automotor de mercancías peligrosas por carretera" del Decreto Único Reglamentario 1079 de 2015 del SectorTransporte, firmada por el representante legal.<span class="c-form-required"> *</span></label><br/>
                <input id="file_trans_combustible" class="c-form-input" type="file" name="file_trans_combustible" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_trans_combustible">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_trans_combustible']['nit'])?'status-saved':'status-nofile'?>" id="status_file_trans_combustible">
                    <?php                         
                        echo isset($datos['file_trans_combustible']['nit'])?'<span class="view" data-url="'.$datos['file_trans_combustible']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">PRESTADORAS DE SERVICIO PARA MUESTREO Y MONITOREO AMBIENTAL: Acreditación por el IDEAM, para toma de muestras y análisis de resultados.<span class="c-form-required"> *</span></label><br/>
                <input id="file_mm_ambiental" class="c-form-input" type="file" name="file_mm_ambiental" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_mm_ambiental">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_mm_ambiental']['nit'])?'status-saved':'status-nofile'?>" id="status_file_mm_ambiental">
                    <?php                         
                        echo isset($datos['file_mm_ambiental']['nit'])?'<span class="view" data-url="'.$datos['file_mm_ambiental']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">SERVICIOS BIÓTICOS: Permiso de estudio global emitido por la autoridad ambiental competente, permiso de colecta.<span class="c-form-required"> *</span></label><br/>
                <input id="file_bioticos" class="c-form-input" type="file" name="file_bioticos" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_bioticos">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_bioticos']['nit'])?'status-saved':'status-nofile'?>" id="status_file_bioticos">
                    <?php                         
                        echo isset($datos['file_bioticos']['nit'])?'<span class="view" data-url="'.$datos['file_bioticos']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">CAL<span class="c-form-required"> *</span></label><br/>
                <input id="file_cal" class="c-form-input" type="file" name="file_cal" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_cal">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_cal']['nit'])?'status-saved':'status-nofile'?>" id="status_file_cal">
                    <?php                         
                        echo isset($datos['file_cal']['nit'])?'<span class="view" data-url="'.$datos['file_cal']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">EMULSIÓN ASFÁLTICA<span class="c-form-required"> *</span></label><br/>
                <input id="file_emuasfaltica" class="c-form-input" type="file" name="file_emuasfaltica" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_emuasfaltica">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_emuasfaltica']['nit'])?'status-saved':'status-nofile'?>" id="status_file_emuasfaltica">
                    <?php                         
                        echo isset($datos['file_emuasfaltica']['nit'])?'<span class="view" data-url="'.$datos['file_emuasfaltica']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">ASFALTO<span class="c-form-required"> *</span></label><br/>
                <input id="file_asfalto" class="c-form-input" type="file" name="file_asfalto" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_asfalto">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_asfalto']['nit'])?'status-saved':'status-nofile'?>" id="status_file_asfalto">
                    <?php                         
                        echo isset($datos['file_asfalto']['nit'])?'<span class="view" data-url="'.$datos['file_asfalto']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">ACEROS DE PERFORACIÓN<span class="c-form-required"> *</span></label><br/>
                <input id="file_acerosperf" class="c-form-input" type="file" name="file_acerosperf" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_acerosperf">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_acerosperf']['nit'])?'status-saved':'status-nofile'?>" id="status_file_acerosperf">
                    <?php                         
                        echo isset($datos['file_acerosperf']['nit'])?'<span class="view" data-url="'.$datos['file_acerosperf']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>
        <!--DOC -->
        <div class="three-columns">
            <fieldset>
                <label class="c-form-label negrita">SERVICIOS DE VIGILANCIA: El archivo debe incluir habilitación de Super Vigilancia. Póliza de RC uso de armas de fuego.<span class="c-form-required"> *</span></label><br/>
                <input id="file_vigilancia" class="c-form-input" type="file" name="file_madera" accept="image/jpeg, image/png, application/pdf">
            </fieldset>
            <!--fieldset>
                <label class="c-form-label negrita" for="fecha_mercantil">Fecha<span class="c-form-required"> *</span></label>
                <input id="cedula_fecha" class="c-form-input" type="text" name="cedula_fecha" placeholder="AAAA-MM-DD" value="<?=@$datos['cedula_fecha']?>">
            </fieldset-->
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_cedula" value="file_vigilancia">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos['file_vigilancia']['nit'])?'status-saved':'status-nofile'?>" id="status_file_madera">
                    <?php                         
                        echo isset($datos['file_vigilancia']['nit'])?'<span class="view" data-url="'.$datos['file_vigilancia']['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>        
    </div>
</div>


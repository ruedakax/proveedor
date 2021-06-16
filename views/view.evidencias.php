<!-- INCIO -  C A B E C E R A   I N F O R M A C I O N-->
<div class="form-box evidencias"><h3>EVIDENCIAS<i class="arrow down"></i></h3></div>
<div class="form-box pequena  item-sucursal error"><p>&nbsp;* DESCRIPCION</p></div>
<div class="form-box evidencias" id="evidencias">
    <div class="c-form" id="listaEvidencias">
        <!--DOC -->
        <div class="four-columns">
            <fieldset>
                <label class="c-form-label negrita">Archivo<span class="c-form-required"> *</span></label><br/>
                <input id="file_1" class="c-form-input" type="file" name="file_1" accept="image/jpeg, image/png, application/pdf">
            </fieldset>            
            <fieldset>
                <label class="c-form-label negrita">Descripcion<span class="c-form-required"> *</span></label><br/>
                <input id="desc_1" class="c-form-input" type="text" name="desc_1" value="">
            </fieldset>            
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="boton_1" value="file_1">Enviar</button>
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
    </div>    
</div>
<div class="form-box">  
    <div class="c-form">
        <div class="two-columns">            
            <button class="c-form-btn" type="button" id="nueva" data-indice-Evidencias="1" data-nit="<?php echo $nit?>">Nueva Evidencia</button>
        </div>
    </div>
</div>
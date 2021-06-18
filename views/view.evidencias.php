<!-- INCIO -  C A B E C E R A   I N F O R M A C I O N-->
<div class="form-box evidencias"><h3>EVIDENCIAS<i class="arrow down"></i></h3></div>
<div class="form-box pequena  item-sucursal error"><p>&nbsp;* Cada evidencia se guarda de manera individual y puede ser modificada cuantas veces sea necesario. Si se requiere una nueva evidencia use el botón <i>Nueva Evidencia</i></p></div>
<div class="form-box evidencias" id="evidencias">
    <div class="c-form" id="listaEvidencias">
        <!--DOC -->
        <?php if(count($datos) <= 0){?>
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
                <label class="c-form-label" for="">Documento Actual<span class="c-form-required"></span></label>
                <p class="status-nofile" id="status_file_1">Sin Asociar</p>
            </fieldset>                         
        </div>
       <?php }else{ ///si ya hay evidencias asociadas
            $cont=0;    
            foreach ($datos as $key => $value) {
                $cont++;
       ?>
        <div class="four-columns">
            <fieldset>
                <label class="c-form-label negrita">Archivo<span class="c-form-required"> *</span></label><br/>
                <input id="<?php echo $key?>" class="c-form-input" type="file" name="<?php echo $key?>" accept="image/jpeg, image/png, application/pdf">
            </fieldset>            
            <fieldset>
                <label class="c-form-label negrita">Descripcion<span class="c-form-required"> *</span></label><br/>
                <input id="<?php echo str_replace('file','desc',$key)?>" class="c-form-input" type="text" name="<?php echo str_replace('file','desc',$key)?>" value="<?php echo $datos[$key]['descripcion']?>">
            </fieldset>            
            <fieldset>
                <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
                <button class="myButton" type="button" id="<?php echo str_replace('file','boton',$key)?>" value="<?php echo $key?>">Enviar</button>
            </fieldset>
            <fieldset>
                <label class="c-form-label" for="">Documento Actual<span class="c-form-required"></span></label>
                <p class="<?php echo isset($datos[$key]['nit'])?'status-saved':'status-nofile'?>" id="status_<?php echo $key?>">
                    <?php                         
                        echo isset($datos[$key]['nit'])?'<span class="view" data-url="'.$datos[$key]['ruta'].'">Ver</span>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>  
    <?php }//fin foreach
        }//fin else
    ?>
    </div>    
</div>
<div class="form-box">  
    <div class="c-form">
        <div class="two-columns">            
            <button class="c-form-btn" type="button" id="nueva" data-indice-Evidencias="<?php echo $cont?>" data-nit="<?php echo $nit?>">Nueva Evidencia</button>
        </div>
    </div>
</div>
<!-- INCIO -  C A B E C E R A   I N F O R M A C I O N-->
<div class="form-box panel_8"><h3>ANEXOS<i class="arrow down"></i></h3></div>
<div class="form-box panel_8 " id="panel_8">
    <div class="c-form">
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
                        echo isset($datos['file_cedula']['nit'])?'<a target="_blank" href="'.$datos['file_cedula']['ruta'].'">Ver</a>':'Sin Asociar';
                    ?>
                </p>
            </fieldset>                         
        </div>                
    </div>
</div>
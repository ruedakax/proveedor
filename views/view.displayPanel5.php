<!-- INCIO -  C A B E C E R A   I N F O R M A C I O N  -->
<div class="form-box panel_5"><h3>5. Control Lavado de Activos y Financiación del Terrorismo (LA/FT)<i class="arrow down"></i></h3></div>
<div class="form-box panel_5" id="panel_5">
  <div class="c-form">
    <div>
      <fieldset>
        <label class="c-form-label negrita" for="i5_p1_check">¿La empresa se encuentra obligada a cumplir normas de prevención de lavado de activos y finaciación del terrorismo? (Ingresos operacionales del año inmediatamente anterior > 160.000 SMMLV)<span class="c-form-required"> *</span></label><br/>
        <input class="c-form-input gi3_p2" type="text" name="" placeholder="" value="<?=@$datos['i5_p1_check']?>" readonly>                          
      </fieldset>
    </div>
    <div id="ley1778">
      <fieldset>
        <label class="c-form-label negrita" for="i5_p2_check">¿La empresa se encuentra obligada a cumplir con la ley 1778 de soborno transnacional?<span class="c-form-required"> *</span></label><br/>
        <input class="c-form-input gi3_p2" type="text" name="" placeholder="" value="<?=@$datos['i5_p2_check']?>" readonly>        
      </fieldset>              
      <fieldset>
        <label class="alt_label c-form-label">Yo :&nbsp;</label>
        <input id="i5_p3_representante" class="c-form-input i5_p3" type="text" name="i5_p3_representante" placeholder="Nombre completo" style="max-width:25.296875%;" value="<?=@$datos['i5_p3_representante']?>" readonly><span class="c-form-required"> *</span>
        <label class="alt_label c-form-label">, actuando en nombre propio ó en calidad de Representante Legal de:&nbsp;</label>
        <input id="i5_p3_representado" class="c-form-input i5_p3" type="text" name="i5_p3_representado" placeholder="Nombre completo" style="max-width:25.296875%;" value="<?=@$datos['i5_p3_representado']?>" readonly><span class="c-form-required"> *</span>
        <label class="alt_label c-form-label">con la firma del presente documento, bajo la gravedad de juramento, declaro que:</label>
      </fieldset>
      <fieldset>
        <label class="alt_label c-form-label">La información que se incluye en el presente documento es real y verificable.</label>
      </fieldset>
      <fieldset>
        <label class="alt_label c-form-label">Que mis recursos y/o los recursos de la persona jurídica que represento (si aplica) provienen de las siguientes fuentes:</label>
      </fieldset>
      <fieldset>
        <input id="i5_p4_fuentes" class="c-form-input i5_p4" type="text" name="i5_p4_fuentes" placeholder="Escriba las fuentes" value="<?=@$datos['i5_p4_fuentes']?>" readonly><span class="c-form-required"> *</span>
      </fieldset>
    </div>              
    <div id="accionistas">
      <fieldset>
        <label class="c-form-label negrita item-sucursal" for="sucursales">Relacione la composición accionaria de la sociedad a vincular con la empresa como cliente mayor o igual al 25% de la propiedad (Circular básica jurídica de la Super Sociedades):</label><br/>                                
      </fieldset>
      <div id="areaAccionistas" class="">
        <?php
        //solo tendrá dato si no se ha guardado una referencia antes
        echo $datos['inicial_comAccionaria'];
        //inicio refBancarias
        foreach ($datos['list_comAccionaria'] as $key => $value) {
            $aclass = $key>0?"item-banref":'';
            $aclose = $key>0?"<div class='close'><span class='x'>x</span></div>":'';
            
        ?>
        <div>
          <?php echo $aclose?>
          <div class="four-columns <?php echo $aclass?>">
            <fieldset>
              <label class="c-form-label negrita" for="acci_nombre_<?php echo ($key)?>">Nombre<span class="c-form-required"> *</span></br></br></label>
              <input id="acci_nombre_<?php echo ($key)?>" class="c-form-input" type="text" name="acci_nombre_<?php echo ($key)?>" placeholder="Nombre" value="<?php echo $value['acci_nombre']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="acci_nit_<?php echo ($key)?>">NIT/CC<span class="c-form-required"> *</span></br></br></label>
              <input id="acci_nit_<?php echo ($key)?>" class="c-form-input" type="text" name="acci_nit_<?php echo ($key)?>" placeholder="Número Nit/CC" value="<?php echo $value['acci_nit']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="acci_porcentaje_<?php echo ($key)?>">% de Participación<span class="c-form-required"> *</span></br></br></label>
              <input id="acci_porcentaje_<?php echo ($key)?>" class="c-form-input" type="text" name="acci_porcentaje_<?php echo ($key)?>"  placeholder="" value="<?php echo $value['acci_porcentaje']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="acci_vinculado_<?php echo ($key)?>">Es Persona Públicamente Expuesta o Vinculada con una de Ellas<span class="c-form-required"> *</span></label>
              <input id="acci_vinculado_<?php echo ($key)?>" class="c-form-input" type="text" name="acci_vinculado_<?php echo ($key)?>" placeholder="escriba NO ó SI y NOMBRE DEL VINCULADO" value="<?php echo $value['acci_vinculado']?>" readonly>
            </fieldset>                    
          </div>
        </div>
        <?php 
        } 
        //fin FOREACH
        ?>
      </div>                      
      <fieldset>
        <label class="c-form-label negrita item-sucursal" for="sucursales">En Caso de que sus Accionistas sean Sociedades, Indique el Nombre de Las Personas Naturales que Tengan un 25% ó Más de las Acciones (Informacion de Beneficiarios Finales):</label><br/>                                
      </fieldset>
      <div id="areaSociedades" class="">
        <?php
        //solo tendrá dato si no se ha guardado una referencia antes
        echo $datos['inicial_comSociedad'];
        //inicio refBancarias
        foreach ($datos['list_comSociedad'] as $key => $value) {
            $aclass = $key>0?"item-banref":'';
            $aclose = $key>0?"<div class='close'><span class='x'>x</span></div>":'';
            
        ?>
        <div>          
          <div class="four-columns <?php echo $aclass?>">
            <fieldset>
              <label class="c-form-label negrita" for="socied_nombre_<?php echo ($key)?>">Nombre Accionista<span class="c-form-required"> *</span></label>
              <input id="socied_nombre_<?php echo ($key)?>" class="c-form-input" type="text" name="socied_nombre_<?php echo ($key)?>" placeholder="Nombre" value="<?php echo $value['socied_nombre']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="socied_identificacion_<?php echo ($key)?>">No. de Identificación<span class="c-form-required"> *</span></label>
              <input id="socied_identificacion_<?php echo ($key)?>" class="c-form-input" type="text" name="socied_identificacion_<?php echo ($key)?>" placeholder="Número Nit/CC" value="<?php echo $value['socied_identificacion']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="socied_empresa_<?php echo ($key)?>">Empresa de la cual es Accionista<span class="c-form-required"> *</span></label>
              <input id="socied_empresa_<?php echo ($key)?>" class="c-form-input" type="text" name="socied_empresa_<?php echo ($key)?>" placeholder="Nombre de la empresa" value="<?php echo $value['socied_empresa']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="socied_porcentaje_<?php echo ($key)?>">% de Participación<span class="c-form-required"> *</span></label>
              <input id="socied_porcentaje_<?php echo ($key)?>" class="c-form-input" type="text" name="socied_porcentaje_<?php echo ($key)?>" placeholder="%" value="<?php echo $value['socied_porcentaje']?>" readonly>
            </fieldset>                    
          </div>
        </div>
        <?php 
        } 
        //fin FOREACH
        ?>
      </div>                      
    </div>
    <div class="break">                
          <label class="c-form-label negrita item-sucursal" for="socied_nombre_1">DECLARACIONES</label>
          <p>Obrando en calidad de representante legal, de manera voluntaria declaro:</p>
          <p>Que todos los datos e informacion suministrada en el presente documento, así como sus anexos corresponden a la realidad.</p> 
          <label class="c-form-label negrita" for="socied_nombre_1">Origen de fondos y Bienes</label>                    
          <p>Que los ingresos de la empresa que represento provienen de actividades licitas, y por consiguiente, no se encuentran relacionados con lavado de activos, financiación del terrorismo ni otro delito conexo con estas conductas punibles.</p>
          <label class="c-form-label negrita" for="socied_nombre_1">Compromiso con el código de Etica</label>                    
          <p>Que hemos sido informados acerca del contenido del Código de Etica de la empresa. el cual ha sido entregado por el gerente general. En este sentido declaramos que conocemos su contenido y nos comprometemos a cumplirlo.</p>
          <label class="c-form-label negrita" for="socied_nombre_1">Conflicto de intereses</label>                    
          <p>Que ninguno de nuestros funcionarios se encuentra incurso en situacion de conflicto de interes. En los eventos en los que existiere algun conflicto de interes nos comprometemos a revelarlo de forma inmediata, entiendo que en quien concurra una situacion de este tipo se encuentra impedido para actuar en representacion de la empresa, salvo autorización expresa de la empresa así mismo declaramos que ni la empresa ni sus empleados directamente o indirectamente involucrados en la relacion comercial, han ofrecido ni ofreceran comisión, privilegio o dadiva alguna a funcionarios de la empresa</p>
          <p>Nos comprometemos a informar directamente o por interpuesta persona, si conocemos que allegados nuestros o de nuestros empleados o familiares cercanos poseen vínculos financieros, accionarios, laborales, profesionales, comerciales, con alguna de la empresa o con empresas competidoras, distribuidoras y/o proveedores de culquiera de sus sociedades subordinadas.</p>
          <!--p>Si actualmente tiene identificado que existe algun conflicto de interes, por favor relacionarlo en el siguiente espacio:</p-->                
    </div>
    <div>
      <label class="c-form-label negrita item-sucursal" for="socied_nombre_1">AUTORIZACIONES</label>
          <p>Autorizo de forma expresa e irrevocable a la empresa para que:</p>
          <p>- Incorporen la información contenida en este formulario en sus informes comerciales o de cualquier otra indole.</p>
          <p>- Lleve a cabo los estudios y análisis que considere pertinentes para la vinculación de la empresa como cliente, los cuales podrán tener fines comerciales, legales, bancarios, financieros, lo anterior incluye, pero no se limita a reportar, procesar, solicitar, divulgar y consultar información en centrales de riesgos y listas restrictivas.</p>
          <p>- Autorizo a las siguientes personas para información y relacionamiento con la sociedad.</p>
    </div>
    <div id="contactosPro">
      <fieldset>
        <label class="c-form-label negrita item-sucursal" for="sucursales">Personas Autorizadas Para Relacionamiento Comercial (Requiere Proteccion De Datos Personales)</label><br/>                                
      </fieldset>
      <div id="areaContactosPro" class="">
        <?php
        //solo tendrá dato si no se ha guardado una referencia antes
        echo $datos['inicial_proContacto'];
        //inicio refBancarias
        foreach ($datos['list_proContacto'] as $key => $value) {
            $aclass = $key>0?"item-banref":'';
            $aclose = $key>0?"<div class='close'><span class='x'>x</span></div>":'';
            
        ?>                  
        <div>        
          <div class="four-columns <?php echo $aclass?>">
            <fieldset>
              <label class="c-form-label negrita" for="contacpro_nombre_<?php echo ($key)?>">Nombre<span class="c-form-required"> *</span></label>
              <input id="contacpro_nombre_<?php echo ($key)?>" class="c-form-input" type="text" name="contacpro_nombre_<?php echo ($key)?>" placeholder="Nombre Completo" value="<?php echo $value['contacpro_nombre']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="contacpro_identificacion_<?php echo ($key)?>">No. de Identificación<span class="c-form-required"> *</span></label>
              <input id="contacpro_identificacion_<?php echo ($key)?>" class="c-form-input" type="text" name="contacpro_identificacion_<?php echo ($key)?>" placeholder="Número Nit/CC" value="<?php echo $value['contacpro_identificacion']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="contacpro_telefono_<?php echo ($key)?>">Teléfono<span class="c-form-required"> *</span></label>
              <input id="contacpro_telefono_<?php echo ($key)?>" class="c-form-input" type="text" name="contacpro_telefono_<?php echo ($key)?>" placeholder="Teléfono" value="<?php echo $value['contacpro_telefono']?>" readonly>
            </fieldset>
            <fieldset>
              <label class="c-form-label negrita" for="contacpro_email_<?php echo ($key)?>">Correo Electrónico<span class="c-form-required"> *</span></label>
              <input id="contacpro_email_<?php echo ($key)?>" class="c-form-input" type="text" name="contacpro_email_<?php echo ($key)?>" placeholder="email" value="<?php echo $value['contacpro_email']?>" readonly>
            </fieldset>                    
          </div>
        </div>
        <?php 
        } 
        //fin FOREACH
        ?>
      </div>                      
    </div>
    <div id="contactos">
      <fieldset>
        <label class="c-form-label negrita item-sucursal" for="sucursales">Otros Contactos (No Requiere Proteccion De Datos Personales)</label><br/>                                
      </fieldset>
      <div id="areaContactos" class="">
          <?php
          //solo tendrá dato si no se ha guardado una referencia antes
          echo $datos['inicial_contacto'];
          //inicio refBancarias
          foreach ($datos['list_contacto'] as $key => $value) {
              $aclass = $key>0?"item-banref":'';
              $aclose = $key>0?"<div class='close'><span class='x'>x</span></div>":'';
              
          ?>                       
          <div>            
            <div class="four-columns <?php echo $aclass?>">
              <fieldset>
                <label class="c-form-label negrita" for="contacto_nombre_<?php echo ($key)?>">Nombre<span class="c-form-required"> *</span></label>
                <input id="contacto_nombre_<?php echo ($key)?>" class="c-form-input" type="text" name="contacto_nombre_<?php echo ($key)?>" placeholder="Nombre Completo" value="<?php echo $value['contacto_nombre']?>" readonly>
              </fieldset>
              <fieldset>
                <label class="c-form-label negrita" for="contacto_identificacion_<?php echo ($key)?>">No. de Identificación<span class="c-form-required"> *</span></label>
                <input id="contacto_identificacion_<?php echo ($key)?>" class="c-form-input" type="text" name="contacto_identificacion_<?php echo ($key)?>" placeholder="Número Nit/CC" value="<?php echo $value['contacto_identificacion']?>" readonly>
              </fieldset>
              <fieldset>
                <label class="c-form-label negrita" for="contacto_telefono_<?php echo ($key)?>">Teléfono<span class="c-form-required"> *</span></label>
                <input id="contacto_telefono_<?php echo ($key)?>" class="c-form-input" type="text" name="contacto_telefono_<?php echo ($key)?>" placeholder="Teléfono" value="<?php echo $value['contacto_telefono']?>" readonly>
              </fieldset>
              <fieldset>
                <label class="c-form-label negrita" for="contacto_email_<?php echo ($key)?>">Correo Electrónico<span class="c-form-required"> *</span></label>
                <input id="contacto_email_<?php echo ($key)?>" class="c-form-input" type="text" name="contacto_email_<?php echo ($key)?>" placeholder="email" value="<?php echo $value['contacto_email']?>" readonly>
              </fieldset>                   
            </div>
          </div>
          <?php 
        } 
        //fin FOREACH
        ?>
      </div>                      
    </div>
    <div class="break">
      <label class="c-form-label negrita item-sucursal" for="socied_nombre_1">INFORMACION IMPORTANTE</label>
          <p> En caso de presentarse cambios en la información de la empresa, posterior al diligenciamiento de la información inicial, se debe reportar a la empresa adjuntando los aportes al cambio , con el fin de actualizar la base de datos.</p>
    </div>              
  </div><!--formc cierre-->
</div><!--formbox cierre-->
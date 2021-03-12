function preparePanel8(objeto){
    document['c-form'].innerHTML = panel_8
}
    
const panel_8 =  `<!-- INCIO -  C A B E C E R A   I N F O R M A C I O N-->
        <div class="form-box panel_8"><h3>8. Prohibición Trabajo Infantil<i class="arrow down"></i></h3></div>
        <div class="form-box panel_8 " id="panel_8">
            <div class="c-form">
                <div>
                    <fieldset>
                        <label class="alt_label c-form-label">Yo :&nbsp;</label>
                        <input id="i8_p1_nombre" class="c-form-input i8_p1" type="text" name="i8_p1_nombre" placeholder="Nombre completo" required style="max-width:25.296875%;"><span class="c-form-required"> *</span>
                        <label class="alt_label c-form-label">&nbsp; representante legal de la empresa</label>
                        <input id="i8_p2_empresa" class="c-form-input i8_p2" type="text" name="i8_p2_empresa" placeholder="Empresa" required style="max-width:25.296875%;"><span class="c-form-required"> *</span><br/><br/>
                        <label class="alt_label c-form-label">con NIT : &nbsp;</label>
                        <input id="i8_p3_nit" class="c-form-input i8_p3" type="text" name="i8_p3_nit" placeholder="NIT" required style="max-width:22.296875%;"><span class="c-form-required"> *</span>
                        <label class="alt_label c-form-label">Y teniendo en cuenta que el trabajo infantil es una violación a los derechos de los niños, niñas y adolescentes,</label>
                        <p>que afecta su proceso de desarrollo, genera condiciones que vulneran el goce de los derechos y complejiza la construcción de proyectos de vida que a su vez inciden en el desarrollo del país, ACEPTO de manera conjunta La adopción y ratificación de los convenios internacionales 138 y 182 de la OIT; y la acogida de la lista de trabajos prohibidos mediante la Resolución No. 1677 de 2008, Código de infancia y adolescencia Ley 1098 de 2006 y normas complementarias.</p>
                        <p>Por ende, Cumpliré íntegramente la PROHIBICIÓN del trabajo infantil de la normatividad descrita anteriormente y propiciar la protección de niños, niñas y adolescentes del estado colombiano.</p>
                    </fieldset>                
                </div>                
            </div>
        </div>`

export default preparePanel8
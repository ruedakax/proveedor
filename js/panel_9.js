import {getPanel,sendFile,sendAdmin} from './envio.js'
import {start} from './general.js'
import {showModal} from './modal.js'

async function preparePanel9(){
  const nit = document.querySelector('#enviar').dataset.nit
  const tipoRegistro = document.querySelector('#enviar').dataset.tipoRegistro
  const tipoPersona = document.querySelector('#enviar').dataset.tipoPersona  
  const parametros = `i=${nit}&accion=preparar&tipo=panel_9&tipoPersona=${tipoPersona}&tipoRegistro=${tipoRegistro}`
  const response = await getPanel(parametros)
  //se despliega el panel en el documento  
  document['c-form'].innerHTML = JSON.parse(response)
  //      
  document.querySelectorAll('.myButton').forEach(item => {
    item.addEventListener('click', () => {
       savePanel9(item.value)
    })
  });

  document.querySelectorAll('.view').forEach(item => {
    console.log(item)
    item.addEventListener('click', () => {
      const url = item.dataset.url
      displayView(url)
    })
  });
  //
  //  
  start()
}

async function savePanel9(file_id){
  const tipo = 'panel_9'
  const nit = document.querySelector('#enviar').dataset.nit
  const tipoRegistro = document.querySelector('#enviar').dataset.tipoRegistro
  const tipoPersona = document.querySelector('#enviar').dataset.tipoPersona  
  const file = document.querySelector(`#${file_id}`).files[0]
  if(file){
    var formdata = new FormData();
    formdata.append('fuente',file_id)
    formdata.append('accion','guardar')
    formdata.append('nit',nit)
    formdata.append('tipo',tipo)
    formdata.append('tipoRegistro',tipoRegistro)
    formdata.append('tipoPersona',tipoPersona)
    console.log(formdata);
    formdata.append(file_id,file);    
    /////PROMESA
    let respuesta = await sendFile(formdata)
    displayResponse(JSON.parse(respuesta))
  }else{
    showModal('error','¡Debe cargar un archivo!')
  }   
}

function displayResponse(respuesta,evidencia){
  if(respuesta.res==='error'){
    let texto = '<p>' + respuesta.mensaje + '</p>'
    respuesta.validaciones.forEach(element => {
      texto += '<p>' + element[1] + '</p>'
    });       
    showModal(respuesta.res,texto)
  }else{    
    let archivo = respuesta.archivo
    createLink(archivo,evidencia)
    showModal(respuesta.res,respuesta.mensaje)
  }
}

function createLink(archivo,evidencia = ''){  
  const raiz = evidencia===''?'uploads':'uploads/evidencias'
  const status = evidencia===''?`#status_${archivo.source}`:`#status_${archivo.source.split('_')[1]}`  
  const link = `<span class="view" data-url="./${raiz}/${archivo.nit}/${archivo.source}.${archivo.extension}">Ver</span>`
  const banner = document.querySelector(status)
  banner.classList.remove('status-nofile')
  banner.classList.add('status-saved')
  banner.innerHTML = link
  document.querySelectorAll('.view').forEach(item => {
    item.addEventListener('click', () => {
      const url = item.dataset.url
      displayView(url)
    })
  });  
}

export function displayView(url){
  const  w=window
  const d=document
  const e=d.documentElement
  const g=d.getElementsByTagName('body')[0]
  let x = w.innerWidth||e.clientWidth||g.clientWidth
  let y = w.innerHeight||e.clientHeight||g.clientHeight
  x = x * 0.80
  y = y * 0.80
  const contentImg = `<img src="${url}">`
  const contentPdf = `<embed src="${url}" width="${x}px" height="${y}px" type="application/pdf">`  
  const type = url.slice(url.length - 3)!="pdf"?'imagen':'pdf'
  const contenido = type === 'pdf'?contentPdf:contentImg
  const layout = `<div class="modal-content-display">
                      <div class="modal-header modal-success">
                        <div class="modal-close">&times;</div>
                        <div class="modal-title">Visor</div>
                      </div>
                      <div class="modal-body">           
                          <p>${contenido}</p> 
                      </div>        
                  </div>`
  window.overlay.classList.remove('oculto')
  window.overlay.innerHTML = layout
  document.querySelectorAll('.modal-close').forEach(item => {
    item.addEventListener('click', () =>  {
        window.overlay.classList.add('oculto')
        //retorna el loader
        window.overlay.innerHTML = '<div class="loader__element"></div>'
    })        
  })
}

export function finalizar(nit){      
    let accion = 'finalizar'
    let formdata = new FormData()
    formdata.append('i',nit)
    formdata.append('accion',accion)
    return sendAdmin(formdata)
}

export  function addEvidencia(id,idContenedor) {
  let nodoEvidencia = `
  <div class="four-columns">
    <fieldset>
        <label class="c-form-label negrita">Archivo<span class="c-form-required"> *</span></label><br/>
        <input id="file_${id}" class="c-form-input" type="file" name="file_${id}" accept="image/jpeg, image/png, application/pdf">
    </fieldset>            
    <fieldset>
        <label class="c-form-label negrita">Descripcion<span class="c-form-required"> *</span></label><br/>
        <input id="desc_${id}" class="c-form-input" type="text" name="desc_${id}" value="">
    </fieldset>            
    <fieldset>
        <label class="c-form-label">Una vez elegido el archivo, oprima enviar para guardarlo</label><br/>
        <button class="myButton" type="button" id="boton_${id}" value="file_${id}">Enviar</button>
    </fieldset>
    <fieldset>
        <label class="c-form-label" for="fecha_mercantil">Documento Actual<span class="c-form-required"></span></label>
        <p class="status-nofile" id="status_${id}">Sin Asociar</p>
    </fieldset>                         
  </div>`  
  const wrapper = document.createElement('div')
  let contenedor = document.querySelector(`#${idContenedor}`)
  wrapper.innerHTML = nodoEvidencia
  contenedor.appendChild(wrapper)
}

export async function guardarEvidencia(id){
    const tipo = 'evidencias'
    const nit = document.querySelector('#nueva').dataset.nit
    const file = document.querySelector(`#file_${id}`).files[0]    
    const descripcion = document.querySelector(`#desc_${id}`).value
    const usuario = document.querySelector('#tabs').dataset.usuario
    if(file && descripcion.trim()!==''){
      var formdata = new FormData()
      formdata.append('accion','guardar')
      formdata.append('nit',nit)
      formdata.append('source',id)
      formdata.append('descripcion',descripcion)
      formdata.append('tipo',tipo)
      formdata.append('usuario',usuario)
      console.log(formdata)      
      formdata.append(`file_${id}`,file);
      /////PROMESA
      let respuesta = await sendFile(formdata)      
      displayResponse(JSON.parse(respuesta),tipo)
    }else{
      showModal('error','¡Debe cargar un archivo y debe tener una descripción!')
    }    
}

export  {preparePanel9,savePanel9}
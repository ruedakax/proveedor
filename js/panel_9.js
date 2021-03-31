import {getPanel,sendFile} from './envio.js'
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

function displayResponse(respuesta){
  if(respuesta.res==='error'){
    let texto = '<p>' + respuesta.mensaje + '</p>'
    respuesta.validaciones.forEach(element => {
      texto += '<p>' + element[1] + '</p>'
    });       
    showModal(respuesta.res,texto)
  }else{    
    let archivo = respuesta.archivo
    createLink(archivo)
    showModal(respuesta.res,respuesta.mensaje)
  }
}

function createLink(archivo){
  const link = `<span class="view" data-url="./uploads/${archivo.nit}/${archivo.source}.${archivo.extension}">Ver</span>`
  const banner = document.querySelector(`#status_${archivo.source}`)
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

function displayView(url){
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
  //const contentPdf = `<iframe src="https://docs.google.com/viewer?url=${url}&embedded=true" frameborder="0" height="500px" width="100%"></iframe></div>`    
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

export  {preparePanel9,savePanel9}
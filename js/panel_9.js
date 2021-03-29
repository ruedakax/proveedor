import {getPanel,sendFile} from './envio.js'
import {start} from './general.js'
import {showModal} from './modal.js' 

async function preparePanel9(){
  const nit = document.querySelector('#enviar').dataset.nit
  const parametros = `i=${nit}&accion=preparar&tipo=panel_9`
  const response = await getPanel(parametros)
  //se despliega el panel en el documento  
  document['c-form'].innerHTML = JSON.parse(response)
  //      
  document.querySelectorAll('.myButton').forEach(item => {
    item.addEventListener('click', () => {
       savePanel9(item.value)
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
  const link = `<a href="./uploads/${archivo.nit}/${archivo.source}.${archivo.extension}">Ver</a>`
  const banner = document.querySelector(`#status_${archivo.source}`)
  banner.classList.remove('status-nofile')
  banner.classList.add('status-saved')
  banner.innerHTML = link
}

export  {preparePanel9,savePanel9}
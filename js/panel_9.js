import {getPanel} from './envio.js'
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
  start()
}

async function savePanel9(file_id){  
  const file = document.querySelector(`#${file_id}`).files[0]
  if(file){
    const nit = document.querySelector('#enviar').dataset.nit
    const tipoRegistro = document.querySelector('#enviar').dataset.tipoRegistro
    const tipoPersona = document.querySelector('#enviar').dataset.tipoPersona
    const parametros = `tipo=panel_9&accion=guardar&tipo_registro=${tipoRegistro}&nit=${nit}&tipoPersona=${tipoPersona}&archivo=${file_id}&file=${file}`
    /////PROMESA
    return await getPanel(parametros)
  }else{
    showModal('error','¡Debe cargar un archivo!')
  }
  
}  

export  {preparePanel9,savePanel9}
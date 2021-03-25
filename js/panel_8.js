import {setPanel,getPanel} from './envio.js'
import {start} from './general.js'

async function preparePanel8(){
  const nit = document.querySelector('#enviar').dataset.nit  
  const parametros = `i=${nit}&accion=preparar&tipo=panel_8`
  const response = await getPanel(parametros)
  //se despliega el panel en el documento  
  document['c-form'].innerHTML = JSON.parse(response)
  //  
  start()
}

async function savePanel8(){
  const objForm = document.querySelector('#c-form')
  const nit = document.querySelector('#enviar').dataset.nit
  const tipoRegistro = document.querySelector('#enviar').dataset.tipoRegistro
  const parametros = `tipo=panel_8&accion=guardar&tipo_registro=${tipoRegistro}&nit=${nit}`
  /////PROMESA
  return await setPanel(objForm,parametros)
}  

export  {preparePanel8,savePanel8}
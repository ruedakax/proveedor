import {showHideByCheck,start} from './general.js'
import {setPanel,getPanel} from './envio.js'
import {addNodo} from './nodos.js'

async function preparePanel2(){
  const nit = document.querySelector('#enviar').dataset.nit
  const parametros = `i=${nit}&accion=preparar&tipo=panel_2`
  const response = await getPanel(parametros)
  //se despliega el panel en el documento
  document['c-form'].innerHTML = JSON.parse(response)
  //
  asociarEventosP2()
  start()
}

function savePanel2(){
  const objForm = document.querySelector('#c-form')
  const nit = document.querySelector('#enviar').dataset.nit
  const tipoRegistro = document.querySelector('#enviar').dataset.tipoRegistro
  const parametros = `tipo=panel_2&accion=guardar&tipo_registro=${tipoRegistro}&nit=${nit}`
  /////PROMESA
  return setPanel(objForm,parametros)
}

function asociarEventosP2(){
  document.querySelectorAll('input').forEach(item => {
    item.addEventListener('focusin', () => {
        item.removeAttribute('required')
    })
  });

  document.querySelectorAll('#i2_p6_check').forEach(item => {
    item.addEventListener('change', () => showHideByCheck(item,'i2_p6'))
  });

  document.querySelectorAll('#i2_p7_check').forEach(item => {
          item.addEventListener('change', () => showHideByCheck(item,'i2_p7'))
  });

  document.querySelectorAll('#i2_p9_check').forEach(item => {
      item.addEventListener('change', () => showHideByCheck(item,'i2_p9'))
  });   

  document.querySelector('#agregarRefBtn').addEventListener('click', () => {
    const container =  document.querySelector('#areaRefBancarias')
    addNodo(container,'refban_banco_',2,'nodoBanco')
  })

  document.querySelector('#agregarComBtn').addEventListener('click', () => {
    const container =  document.querySelector('#areaRefComerciales')
    addNodo(container,'refcom_empresa_',2,'nodoComercial')
  })

  document.querySelectorAll('.x').forEach(item => {
    item.addEventListener('click', (evento) =>  {      
      evento.target.parentElement.parentElement.remove()
    })
  })
}

export  {preparePanel2,savePanel2}

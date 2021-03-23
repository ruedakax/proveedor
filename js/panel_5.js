import {start} from './general.js'
import {setPanel,getPanel} from './envio.js'
import {addNodo} from './nodos.js'

async function preparePanel5(objeto){
  const nit = document.querySelector('#enviar').dataset.nit
  const parametros = `i=${nit}&accion=preparar&tipo=panel_5`
  const response = await getPanel(parametros)
  //se despliega el panel en el documento
  document['c-form'].innerHTML = JSON.parse(response)
  //
  asociarEventosP5()
  start()  
}

function savePanel5(){

}

function asociarEventosP5(){
  const tipoPersona = document.querySelector('#enviar').dataset.tipoPersona
  showControl(tipoPersona)

  document.querySelectorAll('input').forEach(item => {
    item.addEventListener('focusin', () => {
        item.removeAttribute('required')
    })
  });

  document.querySelector('#agregarAcciBtn').addEventListener('click', () => {
      const container =  document.querySelector('#areaAccionistas')
      addNodo(container,'acci_nombre_',2,'nodoAccionistas')
  })

  document.querySelector('#agregarSociedBtn').addEventListener('click', () => {
      const container =  document.querySelector('#areaSociedades')
      addNodo(container,'socied_nombre_',2,'nodoSociedades')
  })   

  document.querySelector('#agregarContactoProBtn').addEventListener('click', () => {
    const container =  document.querySelector('#areaContactosPro')
    addNodo(container,'contacpro_nombre_1',2,'nodoContactosPro')
  })

  document.querySelector('#agregarContactoBtn').addEventListener('click', () => {
      const container =  document.querySelector('#areaContactos')
      addNodo(container,'contac_nombre_1',2,'nodoContactos')
  })    
}

function showControl(tipoPersona){
  if(tipoPersona ==='natural'){
    window.ley1778.classList.add('oculto')
    window.accionistas.classList.add('oculto')
  }
}

export  {preparePanel5,savePanel5}
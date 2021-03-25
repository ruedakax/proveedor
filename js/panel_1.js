import {showHide,showHideByCheck,start} from './general.js'
import {setPanel,getPanel} from './envio.js'
import {addNodo} from './nodos.js'

async function preparePanel1(){
  const nit = document.querySelector('#enviar').dataset.nit  
  const parametros = `i=${nit}&accion=preparar&tipo=panel_1`
  const response = await getPanel(parametros)
  //se despliega el panel en el documento  
  document['c-form'].innerHTML = JSON.parse(response)
  //
  asociarEventos()
  start()
}

////*Envio del panel */    
async function savePanel1(){
  const objForm = document.querySelector('#c-form')
  const tipoRegistro = document.querySelector('#enviar').dataset.tipoRegistro
  const parametros = `tipo=panel_1&accion=guardar&tipo_registro=${tipoRegistro}`                     
  /////PROMESA
  return await setPanel(objForm,parametros)
}

/*asociacion de eventos para elementos del panel que lo requieren*/
function asociarEventos(){
    window.tipo_persona.selectedIndex = 0;

    window.tipo_persona.addEventListener('change', () => {
      showHide('juridica')
      document.querySelector('#rep_legal').value = ""
      document.querySelector('#rep_documento').value = ""
      document.querySelector('#rep_email').value = ""
    })

    document.querySelectorAll('input').forEach(item => {
      item.addEventListener('focusin', () => {
          item.removeAttribute('required')
      })
    });

    document.querySelectorAll('#autoretenedor').forEach(item => {
      item.addEventListener('change', () => {
        showHideByCheck(item,'autoretenedor')
        if(item.value==='NO'){
          document.querySelector('#retenedor_res').value = ""          
        }
      })
    });

    document.querySelectorAll('.checkSucursales').forEach(item => {        
        item.addEventListener('change', () => {
          showHideByCheck(item,'areaSucursales')
          if(item.value==='NO')
            window.areaSucursales.innerHTML = ''
        })
    });

    document.querySelector('#agregarBtn').addEventListener('click', () => {
      const container =  document.querySelector('#areaSucursales')
      addNodo(container,'dir_suc_',1,'nodoSucursal')
    })
    
    document.querySelectorAll('.x').forEach(item => {
      item.addEventListener('click', (evento) =>  {      
        evento.target.parentElement.parentElement.remove()
      })
    })
}

export {preparePanel1,savePanel1}
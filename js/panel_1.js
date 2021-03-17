import {showHide,showHideByCheck,start} from './general.js'
import {setPanel,getPanel} from './envio.js'
import {addNodo} from './nodos.js'

const panel = 'panel_1'

async function preparePanel1(){
  const nit = document.querySelector('#enviar').dataset.nit
  console.log(nit);
  const parametros = {'nit':nit,
                   'accion' : 'preparar',
                   'tipo':panel                   
                  }
  const response = await getPanel(parametros)
  //se despliega el panel en el documento  
  document['c-form'].innerHTML = JSON.parse(response)
  //
  asociarEventos()
  start()  
}

////*Envio del panel */    
function savePanel1(){
  const objForm = document.querySelector('#c-form')

  const parametros = {'tipo' : panel,
                       'accion' : 'guardar',
                       'tipo_registro' : document.querySelector('#enviar').dataset.tipoRegistro
                     }
  /////PROMESA
  return setPanel(objForm,parametros)
}

/*asociacion de eventos para elementos del panel que lo requieren*/
function asociarEventos(){
    window.tipo_persona.selectedIndex = 0;

    window.tipo_persona.addEventListener('change', () => showHide('juridica'),false)

    document.querySelectorAll('#autoretenedor').forEach(item => {
      item.addEventListener('change', () => showHideByCheck(item,'autoretenedor'))
    });

    document.querySelectorAll('.checkSucursales').forEach(item => {        
        item.addEventListener('change', () => {
          showHideByCheck(item,'areaSucursales')
          if(item.value==='NO')
            window.areaSucursales.innerHTML = '';
        })
    });

    document.querySelector('#agregarBtn').addEventListener('click', () => {
      const container =  document.querySelector('#areaSucursales')
      addNodo(container,'dir_suc_',1,'nodoSucursal')
    })  
}

export {preparePanel1,savePanel1}
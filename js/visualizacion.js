//Se encarga de la funcionalidad de las secciones
import {getPanel} from './envio.js'
import {displayView} from './panel_9.js'


document.querySelectorAll('.tablinks').forEach(item => {    
    item.addEventListener('click', () => {
        document.querySelectorAll('.tablinks').forEach(tab => {  tab.classList.remove('active') })
        item.classList.add('active')
        visualizar(item.id)
    })
});

async function visualizar(panel){
    const nit = document.querySelector('#tabs').dataset.nit
    const tipoPersona = document.querySelector('#tabs').dataset.tipoPersona
    const parametros = `i=${nit}&accion=mostrar&tipo=${panel}&tipoPersona=${tipoPersona}`
    const response = await getPanel(parametros)
    //se despliega el panel en el documento
    document['c-form'].innerHTML = JSON.parse(response)
    //asocia el evento especifico para la sección de anexos
    if(panel === 'panel_9')  {
        document.querySelectorAll('.view').forEach(item => {
            item.addEventListener('click', () => {
              const url = item.dataset.url
              displayView(url)
            })
          });  
    }
  }


//Se encarga de la funcionalidad de las secciones
import {getPanel,sendAdmin} from './envio.js'
import {displayView} from './panel_9.js'


document.querySelectorAll('.tablinks').forEach(item => {    
    item.addEventListener('click', () => {
        window.overlay.classList.remove('oculto')
        document.querySelectorAll('.tablinks').forEach(tab => {  tab.classList.remove('active') })
        item.classList.add('active')
        visualizar(item.id)
    })
});
async function visualizar(panel){    
    const nit = document.querySelector('#tabs').dataset.nit
    const tipoPersona = document.querySelector('#tabs').dataset.tipoPersona
    const accion = 'mostrar'    
    let response    
    if(panel ==='aprobacion'){
      let formdata = new FormData()
      formdata.append('i',nit)
      formdata.append('accion',accion)
      response = await sendAdmin(formdata)
    }else{
      const parametros = `i=${nit}&accion=${accion}&tipo=${panel}&tipoPersona=${tipoPersona}`
      response = await getPanel(parametros)
    }    
    //se despliega el panel en el documento
    document['c-form'].innerHTML = JSON.parse(response)    
    //aventos de los botones de la seccion de aprobacion
    document.querySelectorAll('.c-form-btn').forEach(item => {
      item.addEventListener('click',() =>{
        ejecutar(nit,item.id)
      })
    })
    //asocia el evento especifico para la sección de anexos
    if(panel === 'panel_9')  {
        document.querySelectorAll('.view').forEach(item => {
            item.addEventListener('click', () => {
              const url = item.dataset.url
              displayView(url)
            })
          });  
    }
    window.overlay.classList.add('oculto')
}

async function ejecutar(nit,accion){
  let formdata = new FormData()
  formdata.append('i',nit)
  formdata.append('accion',accion)
  response = await sendAdmin(formdata)
  console.log(response)
}


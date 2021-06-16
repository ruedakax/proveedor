//Se encarga de la funcionalidad de las secciones
import {getPanel,sendAdmin} from './envio.js'
import {displayView,addEvidencia,guardarEvidencia} from './panel_9.js'
import {showModal} from './modal.js'


document.querySelectorAll('.tablinks').forEach(item => {    
    item.addEventListener('click', () => {
        window.overlay.classList.remove('oculto')
        document.querySelectorAll('.tablinks').forEach(tab => {  tab.classList.remove('active') })
        item.classList.add('active')
        if(item.id==="administracion"){
          window.location.replace("./administrar.php")
        }else{
          visualizar(item.id)
        }
        
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
        panel!=='evidencias'?ejecutar(nit,item.id):nuevaEvidencia()
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
    //asocia evento especifico a los botones de enviar 
    //cuando son del panel de evidencias
    let res1 = panel==='evidencias'?eventoBtnEvidencia():''
    //asocia el evento para la seccion de Evidencias    
    window.overlay.classList.add('oculto')
}

async function ejecutar(nit,accion){
  window.overlay.classList.remove('oculto') 
  let observaciones = document.querySelector('#observaciones').value  
  if(accion ==='revisar' && observaciones ==''){
    showModal('error','Debe completar las observaciones')
    return false
  }
  let formdata = new FormData()
  formdata.append('i',nit)
  formdata.append('accion',accion)
  formdata.append('observaciones',observaciones)
  await sendAdmin(formdata).then((response)=>{
    let respuesta = JSON.parse(response)
    showModal(respuesta.res,respuesta.mensaje)
    document.querySelector('#observaciones').value = respuesta.res !='error'?'':observaciones
  })  
}

function nuevaEvidencia(){    
  let indice = parseInt(document.querySelector('#nueva').dataset.indiceEvidencias) + 1
  document.querySelector('#nueva').dataset.indiceEvidencias = indice
  addEvidencia(indice,'listaEvidencias')
  eventoBtnEvidencia()
}

function eventoBtnEvidencia(){
  document.querySelectorAll('.myButton').forEach(element => {    
    element.addEventListener('click',(event)=>{
      let id = event.target.id.split("_")[1]
      guardarEvidencia(id)
    })
  });
  return true
}



import {showHideByCheck,start} from './general.js'
import {setPanel,getPanel} from './envio.js'

async function preparePanel3(){
  const nit = document.querySelector('#enviar').dataset.nit
  const tipoPersona = document.querySelector('#enviar').dataset.tipoPersona
  const parametros = `i=${nit}&accion=preparar&tipo=panel_3&tipoPersona=${tipoPersona}`
  const response = await getPanel(parametros)
  //se despliega el panel en el documento  
  document['c-form'].innerHTML = JSON.parse(response)
  //
  asociarEventosP3()
  start()
}

function savePanel3(){
  const objForm = document.querySelector('#c-form')
  const nit = document.querySelector('#enviar').dataset.nit
  const tipoRegistro = document.querySelector('#enviar').dataset.tipoRegistro
  const parametros = `tipo=panel_3&accion=guardar&tipo_registro=${tipoRegistro}&nit=${nit}`
  /////PROMESA
  return setPanel(objForm,parametros)
}

function showGestion(item){
  let tipoPersona = document.querySelector('#enviar').dataset.tipoPersona    
  if(item.value === 'NO' && tipoPersona ==='juridica'){
    window.conGestion.classList.remove('oculto')
    window.sinGestion.classList.remove('oculto')
  }else if(item.value === 'SI' && tipoPersona ==='juridica'){
    window.conGestion.classList.remove('oculto')
    window.sinGestion.classList.add('oculto')
  }else{
    window.conGestion.classList.add('oculto')
    window.sinGestion.classList.remove('oculto')
  }
}

function asociarEventosP3(){
  
  document.querySelectorAll('input').forEach(item => {
    item.addEventListener('focusin', () => {
        item.removeAttribute('required')
    })
  });
  
  document.querySelectorAll('#i3_p1_check').forEach(item => {      
      item.addEventListener('change', () => {
        showHideByCheck(item,'i3_p1')
        showGestion(item)
        if(item.value==='NO'){
          document.querySelector('#i3_p1_ec_asesora').value = ""
          document.querySelectorAll('.certi').forEach(elemento=> {
            elemento.checked = false            
          })
        }            
      })        
  });    

  document.querySelectorAll('#gi3_p1_check').forEach(item => {
      item.addEventListener('change', () => {        
        showHideByCheck(item,'gi3_p1')
        document.querySelector('#gi3_p1_control_calidad').setAttribute('value','')
        document.querySelector('#gi3_p1_control_calidad').value = ""
    })
  });

  document.querySelectorAll('#gi3_p2_check').forEach(item => {
      item.addEventListener('change', () => {
        showHideByCheck(item,'gi3_p2')
        document.querySelector('#gi3_p2_sellos').setAttribute('value','')
        document.querySelector('#gi3_p2_sellos').value = ""        
    })
  });
  
  document.querySelectorAll('.x').forEach(item => {
    item.addEventListener('click', () =>  remove(item),false)        
  })
}

export  {preparePanel3,savePanel3}
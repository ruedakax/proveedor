//Se encarga de la funcionalidad de las secciones
import {sendAdmin} from './envio.js'
import {displayErrors} from './general.js'
import {showModal} from './modal.js'

document.querySelector('#programar').addEventListener('click',()=>{
  email = document.querySelector('#email').value
  nit = document.querySelector('#nit').value  
  let llamado = email!=='' && nit!==''?agregar(nit,email):showModal('error',"No ha completado los datos")
  //agregar()*/
})

eventoRadios()

async function agregar(nit,email){
  window.overlay.classList.remove('oculto')
  let formdata = new FormData()
  formdata.append('nit',nit)
  formdata.append('email',email)
  formdata.append('accion','agregar')
  /////PROMESA
  let respuesta = await sendAdmin(formdata)
  respuesta = JSON.parse(respuesta)
  let ans = displayErrors(respuesta)
  if(ans){
    listar()
    showModal(respuesta.res,respuesta.mensaje)
  }
}

async function listar(){
  let formdata = new FormData()
  formdata.append('accion','listar')
  /////PROMESA  
  let respuesta = await sendAdmin(formdata)
  respuesta = JSON.parse(respuesta)
  document.querySelector('#lista').innerHTML = respuesta;
  eventoRadios()
}

function eventoRadios(){
  document.querySelectorAll('.item-list').forEach(item=>{
    item.addEventListener('click',()=>{
      document.querySelector('#nit').setAttribute('value',item.getAttribute('id'))
      document.querySelector('#email').setAttribute('value',item.getAttribute('value'))            
    })   
  })  
}
//Se encarga de la funcionalidad de las secciones
import {sendAdmin} from './envio.js'
import {displayErrors} from './general.js'
import {showModal} from './modal.js'

document.querySelectorAll('.tablinks').forEach(item => {
  item.addEventListener('click', () => {
      if(item.id==="administracion"){
        window.location.replace("./administrar.php")
      }else{
        window.location.replace("./roles.php")
      }
  })
});

document.querySelector('#otorgar').addEventListener('click',()=>{
  let usuario = document.querySelector('#usuario').value  
  let secciones = []
  let checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
  checkboxes.forEach(element => {
    secciones.push(element.value)
  });  
  let llamado = usuario!==''?agregar(usuario,secciones):showModal('error',"No ha completado los datos")
})

/*document.querySelector('#buscar').addEventListener('click',()=>{  
  let busqueda = document.querySelector('#busqueda').value  
  let llamado = =='' && nit!==''?buscar(nit,email):showModal('error',"No ha completado los datos")  
})*/

document.querySelector('#buscar').addEventListener('click',(event)=>{  
  document.querySelector('#load_search').classList.remove('oculto')
  let busqueda = document.querySelector('#busqueda').value
  buscar(busqueda).then((res)=>{
    console.log(res)
    document.querySelector('#load_search').classList.add('oculto')
  })  
})

document.querySelectorAll('.eliminar').forEach(element => {
  element.addEventListener('click',(event)=>{
    eliminar(event.target)
    event.target.parentNode.remove()    
  })
});


eventoRadios()

async function agregar(usuario,permisos){
  window.overlay.classList.remove('oculto')
  let formdata = new FormData()
  formdata.append('usuario',usuario)
  formdata.append('permisos',permisos)
  formdata.append('accion','agregar')  
  /////PROMESA
  let respuesta = await sendAdmin(formdata,'./api_rol.php')
  respuesta = JSON.parse(respuesta)
  let ans = displayErrors(respuesta)
  console.log(ans)
  if(ans){
    listar()
    showModal(respuesta.res,respuesta.mensaje)
  }
}

async function eliminar(usuario){
  window.overlay.classList.remove('oculto')
  let formdata = new FormData()
  formdata.append('usuario',usuario.value)
  formdata.append('accion','eliminar')  
  /////PROMESA
  let respuesta = await sendAdmin(formdata,'./api_rol.php')
  respuesta = JSON.parse(respuesta)
  let ans = displayErrors(respuesta)
  console.log(ans)
  if(ans){
    listar()
    showModal(respuesta.res,respuesta.mensaje)
  }
}

async function listar(){
  let formdata = new FormData()
  formdata.append('accion','listar')
  /////PROMESA  
  let respuesta = await sendAdmin(formdata,'./api_rol.php')
  respuesta = JSON.parse(respuesta)
  document.querySelector('#lista').innerHTML = respuesta;
  eventoRadios()
}

async function buscar(busqueda){
  let formdata = new FormData()
  formdata.append('accion','buscar')
  formdata.append('busqueda',busqueda)
  /////PROMESA  
  let respuesta = await sendAdmin(formdata,'./api_rol.php')
  respuesta = JSON.parse(respuesta)
  document.querySelector('#lista').innerHTML = respuesta;
  eventoRadios()
}

function eventoRadios(){
  document.querySelectorAll('.item-list').forEach(item=>{
    item.addEventListener('click',()=>{      
      document.querySelector('#usuario').setAttribute('value',item.getAttribute('id'))
      let permisos = item.getAttribute('value')
      setChecks(permisos)      
    })   
  })
}

function setChecks(cadena){
  let arreglo = cadena.split(',')
  let checkboxes = document.querySelectorAll('input[type=checkbox]')
  checkboxes.forEach(element => {
    console.log(element)
    element.checked = arreglo.includes(element.value)?true:false
  });  
}
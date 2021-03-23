import {mover,getIndex} from './general.js'
import {preparePanel1,savePanel1} from './panel_1.js'
import {preparePanel2,savePanel2} from './panel_2.js'
import {preparePanel3,savePanel3} from './panel_3.js'
import {preparePanel4,savePanel4} from './panel_4.js'
import {preparePanel5,savePanel5} from './panel_5.js'
import {preparePanel6,savePanel6} from './panel_6.js'
import {preparePanel7,savePanel7} from './panel_7.js'
import {preparePanel8,savePanel8} from './panel_8.js'
//alerts
import {showModal} from './modal.js' 

const funciones = {
                   1:{prepare:preparePanel1,save:savePanel1},
                   2:{prepare:preparePanel2,save:savePanel2},
                   3:{prepare:preparePanel3,save:savePanel3},
                   4:{prepare:preparePanel4,save:savePanel4},
                   5:{prepare:preparePanel5,save:savePanel5},
                   6:{prepare:preparePanel6,save:savePanel6},
                   7:{prepare:preparePanel7,save:savePanel7},
                   8:{prepare:preparePanel8,save:savePanel8}
                }

export function showSection(){
    window.overlay.classList.remove('oculto')
    //obtiene el indice del panel a mostrar
    const index = getIndex()        
    //llamado dinamico de funciones según el panel
    funciones[index].prepare()    
}

export function moveSection(tipo){        
    if(tipo==="adelante"){
        adelantarSeccion(tipo)
    }else{
        //ToDo:cuando va atrás
    }        
}

/*señala los input que no pasaron la validacion según la respuesta del servidor*/
function displayErrors(respuesta){
    if(respuesta.res==='error'){
      showModal(respuesta.res,respuesta.mensaje)
      respuesta.validaciones.forEach(element => {        
        //objeto = document.querySelector(`#${element[0]}`)
        //objeto.setAttribute('required', '')
        window[element[0]].setAttribute('required', '')
      });
      return false
    }else{
      return true
    }
}

function adelantarSeccion(tipo){
    let res = funciones[getIndex()].save()
    //promesa
    res.then(function(response){
        const respuesta = JSON.parse(response)
        let ans = displayErrors(respuesta)        
        if(ans){
            mover(tipo)            
            showSection()
            showModal(respuesta.res,respuesta.mensaje)
            let actual = parseInt(document.querySelector('#buttonPanel').dataset.current)
            if(actual > 0){
                window.volver.classList.remove('oculto')
            }else{
                window.volver.classList.add('oculto')
            }            
        }else{

        }           
    })
    .catch(function(response){
        console.log(response)   
    });
}


import {mover,getIndex,displayErrors} from './general.js'
import {showModal} from './modal.js' 
import {preparePanel1,savePanel1} from './panel_1.js'
import {preparePanel2,savePanel2} from './panel_2.js'
import {preparePanel3,savePanel3} from './panel_3.js'
import {preparePanel4,savePanel4} from './panel_4.js'
import {preparePanel5,savePanel5} from './panel_5.js'
import {preparePanel6,savePanel6} from './panel_6.js'
import {preparePanel7,savePanel7} from './panel_7.js'
import {preparePanel8,savePanel8} from './panel_8.js'
import {preparePanel9,savePanel9,finalizar} from './panel_9.js'
//alerts


const funciones = {
                   1:{prepare:preparePanel1,save:savePanel1},
                   2:{prepare:preparePanel2,save:savePanel2},
                   3:{prepare:preparePanel3,save:savePanel3},
                   4:{prepare:preparePanel4,save:savePanel4},
                   5:{prepare:preparePanel5,save:savePanel5},
                   6:{prepare:preparePanel6,save:savePanel6},
                   7:{prepare:preparePanel7,save:savePanel7},
                   8:{prepare:preparePanel8,save:savePanel8},
                   9:{prepare:preparePanel9,save:savePanel9}
                }

export function showSection(){
    //obtiene el indice del panel a mostrar
    const index = getIndex()
    //
    const limite_sup = JSON.parse(document.querySelector('#buttonPanel').dataset.paneles).length
    let actual = parseInt(document.querySelector('#buttonPanel').dataset.current)    
    const volver = actual > 0?window.volver.classList.remove('oculto'):window.volver.classList.add('oculto')
    //const enviar = actual === limite_sup-1?window.enviar.classList.add('oculto'):window.enviar.classList.remove('oculto')        
    window.enviar.innerHTML = actual === limite_sup-1?"FINALIZAR":"SIGUIENTE"
    //llamado dinamico de funciones según el panel
    funciones[index].prepare()
}

export function moveSection(tipo){
    window.overlay.classList.remove('oculto')
    let res = funciones[getIndex()].save()
    //promesa
    res.then(function(response){
        const respuesta = JSON.parse(response)
        let ans = displayErrors(respuesta)
        if(ans){
            mover(tipo)        
            showSection()
            showModal(respuesta.res,respuesta.mensaje)
        }
    })
    .catch(function(response){
        console.log(response)
    });            
}

export async function finalSection(){
    const nit = document.querySelector('#enviar').dataset.nit  
    await finalizar(nit).then((response)=>{
        let respuesta = JSON.parse(response)
        showModal(respuesta.res,respuesta.mensaje)
        setTimeout(()=>window.location.replace("http://www.sp.com.co/"), 4000);        
    })
}




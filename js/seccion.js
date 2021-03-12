import {mover,start,getIndex} from './general.js'
import {preparePanel1,savePanel1} from './panel_1.js'
import preparePanel2 from './panel_2.js'
import preparePanel3 from './panel_3.js'
import preparePanel4 from './panel_4.js'
import preparePanel5 from './panel_5.js'
import preparePanel6 from './panel_6.js'
import preparePanel7 from './panel_7.js'
import preparePanel8 from './panel_8.js'

const funciones = {
                   1:{prepare:preparePanel1,save:savePanel1},
                   2:{prepare:preparePanel2},
                   3:{prepare:preparePanel3},
                   4:{prepare:preparePanel4},
                   5:{prepare:preparePanel5},
                   6:{prepare:preparePanel6},
                   7:{prepare:preparePanel7},
                   8:{prepare:preparePanel8}
                }

//conjunto de checboxes que permiten seleccion multiple
const no_sel_unica = ["i3_p1_certificado","i2_p9_postventa"]

export function showSection(){
    window.overlay.classList.remove('oculto')
    return new Promise(resolve => setTimeout(()=>{
        const index = getIndex()
        //llamado dinamico de funciones según el panel
        funciones[index].prepare()
        start()
        /// se llama al setTimeout definido
        resolve()
        ///       
    },10));    
}

export function moveSection(tipo){
    if(tipo==="adelante"){
        funciones[getIndex()].save()
    }else{
        //ToDo:cuando va atrás
    }
    mover(tipo)
    showSection().then(()=>{
            let actual = parseInt(document.querySelector('#buttonPanel').dataset.current)
            if(actual > 0){
                window.volver.classList.remove('oculto')
            }else{
                window.volver.classList.add('oculto')
            }
    })
}
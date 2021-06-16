import {showModal} from './modal.js' 

export function showHide(idElementToHide) {
    const id =`#${idElementToHide}`
    const element = document.querySelector(id)
    element.classList.toggle('oculto')
}

export function showHideSection(idElementToHide,arrowElement) {
    console.log(idElementToHide)    
    showHide(idElementToHide)
    arrowElement.classList.toggle('down')
    arrowElement.classList.toggle('up')
}

export function uncheck(name,value){    
    const fullName = `input[name="${name.replaceAll('[]','')}"]`    
    console.log(fullName)
    document.querySelectorAll(fullName).forEach(item => {        
        item.checked = item.value === value?true:false
    });
}

export function showHideByCheck(checkbox,clase){
    if(checkbox.value==='SI'){
        document.querySelectorAll('.' + clase).forEach(item => {
            item.classList.remove('oculto')
        });    
    }else{
        document.querySelectorAll('.' + clase).forEach(item => {
            item.classList.add('oculto')
        });    
    }
}

export function mover(tipo){
    const paneles = JSON.parse(document.querySelector('#buttonPanel').dataset.paneles)
    let actual = parseInt(document.querySelector('#buttonPanel').dataset.current)    
    saveData(paneles[actual])
    const step = actual //< paneles.length - 1?actual:-1    
    document.querySelector('#buttonPanel').dataset.current = tipo==='adelante'?step + 1:step - 1    
}

/*Obtiene el indice del array sobre el que se mueven los diferentes paneles*/
export function getIndex(){
    const paneles = JSON.parse(document.querySelector('#buttonPanel').dataset.paneles)
    const actual = document.querySelector('#buttonPanel').dataset.current    
    const indice = paneles[actual]
    return parseInt(indice)
}

export function start(){
    //elminar la opcion inicial
    //window.overlay.classList.add('oculto')
    window.buttonPanel.classList.remove('oculto')
    window.inicio.innerHTML = ""
    window.inicio.classList.add('oculto')
    //scroll to top
    window.scrollTo(0,0)
}

//guadar valores de un panel que son requeridos en validaciones de otros paneles
export function saveData(currentPanel){
    try {
        switch (currentPanel) {
            case 1:                
                //guardar el valor de tipo persona                
                document.querySelector('#enviar').dataset.tipoPersona = window.tipo_persona.value
                //
                break;        
            default:
                break;
        }        
    }catch (error) {
        console.log("saveData no match:"+error)
    }
}

/*señala los input que no pasaron la validacion según la respuesta del servidor*/
export function displayErrors(respuesta){
    if(respuesta.res==='error'){
      showModal(respuesta.res,respuesta.mensaje)
      respuesta.validaciones.forEach(element => {        
        let objeto = document.querySelector(`#${element[0]}`)        
        objeto.setAttribute('required', '')
        //window[element[0]].setAttribute('required', '')
      });
      return false
    }else{
      return true
    }
}

/*document.querySelectorAll('.item-list').forEach(elemento=>{
        console.log(elemento.getAttribute('id'))
        console.log(item.getAttribute('id'))
})*/
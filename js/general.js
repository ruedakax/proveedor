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
        console.log(item.checked)
        console.log(item.value)
        console.log(value)
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
    const step = actual < paneles.length - 1?actual:-1    
    document.querySelector('#buttonPanel').dataset.current = tipo==='adelante'?step + 1:step - 1    
}

/*Obtiene el indice del array sobre el que se mueven los diferentes paneles*/
export function getIndex(){
    const paneles = JSON.parse(document.querySelector('#buttonPanel').dataset.paneles)
    const actual = document.querySelector('#buttonPanel').dataset.current    
    const indice = paneles[actual]
    return parseInt(indice)
}
/*genera el objeto segun el formulario que se pase por parametro*/
export function serialize(objForm){
    let otros = ['radio','checkbox'] 
    let data_final = []  
    let data = Array.from(objForm);
    data.forEach(element => {    
      if(element.name!==''){
        if(otros.includes(element.type)){
          if(element.type==='radio' && element.checked){
            data_final[element.name] = element.value;
          }else if(getKey(data_final,element.name)){
            data_final[element.name] = [element.value]
          }else{
            data_final[element.name].push(element.value)
          }     
        }else{
          data_final[element.name] = element.value;          
        }
      }
    });
    return JSON.stringify(data_final)
  }
  
function getKey(arreglo,valor){  
const key = arreglo.findIndex(llave=>llave === valor)
return key
}

export function start(){
    //elminar la opcion inicial
    window.overlay.classList.add('oculto')
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
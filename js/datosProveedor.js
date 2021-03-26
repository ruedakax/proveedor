//Se encarga de la funcionalidad de las secciones
import {showSection,moveSection} from './seccion.js'

//const opciones_tipo = {'cliente':[1,5,6,8],'proveedor':[1,2,3,4,5,6,7,8],'contratista':[1,2,3,4,5,6,7,8]}
const opciones_tipo = {'cliente':[1,9,5,6,8],'proveedor':[1,2,3,5,6,7,8],'contratista':[1,2,3,5,6,7,8]}

document.querySelectorAll('.tipo_registro').forEach(item => {
    item.addEventListener('change', () => {
        document.querySelector('#buttonPanel').dataset.paneles = JSON.stringify(opciones_tipo[item.value])        
        document.querySelector('#enviar').dataset.tipoRegistro = item.value 
        showSection()
    })
});

document.querySelectorAll('.tipo_registro').forEach(item => {
    item.removeAttribute('checked');
})

document.querySelector('#enviar').addEventListener('click', () => {
    moveSection("adelante")
})

document.querySelector('#volver').addEventListener('click', () => {
    moveSection("atras")
})    


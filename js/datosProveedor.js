//Se encarga de la funcionalidad de las secciones
import {showSection,moveSection,finalSection} from './seccion.js'
import {showModal} from './modal.js' 

const opciones_tipo = {'cliente':[1,5,6,8,9],'proveedor':[1,2,3,5,6,7,8,9],'contratista':[1,2,3,5,6,7,8,9]}

document.querySelectorAll('.tipo_registro').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelector('#buttonPanel').dataset.paneles = JSON.stringify(opciones_tipo[item.value])
        document.querySelector('#enviar').dataset.tipoRegistro = item.value
        showSection()
    })
});

document.querySelector('#enviar').addEventListener('click', (event) => {    
    const movimiento = event.target.textContent!="FINALIZAR"?moveSection("adelante"):finalSection();    
})

document.querySelector('#volver').addEventListener('click', () => {
    moveSection("atras")
})    


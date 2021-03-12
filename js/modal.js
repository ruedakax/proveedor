export function showModal(clase,texto){
    const titulos = {'error':'¡ERROR!','success':'¡OK!','warning':'¡ATENCION!'}
    let content =     
    `<div class="modal-content">
        <div class="modal-header modal-${clase}">
          <div class="modal-close">&times;</div>
          <div class="modal-title">${titulos[clase]}</div>
        </div>
        <div class="modal-body">           
            <p>${texto}</p> 
        </div>        
    </div>`
    window.overlay.classList.remove('oculto')
    window.overlay.innerHTML = content
     //incluimos la accion de cerrar (X)
    document.querySelectorAll('.modal-close').forEach(item => {
        item.addEventListener('click', () =>  {
            window.overlay.classList.add('oculto')
            window.overlay.innerHTML = ''
        })        
    })
}
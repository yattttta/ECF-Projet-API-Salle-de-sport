$(document).ready(() => {
    const modalContainer = document.querySelector('.modal-container')
    const modalTriggers = document.querySelectorAll('.modal-trigger')
    const modalAdd = document.querySelector('.modalAdd')

       
   
    function removeModal() {        
        modalContainer.classList.remove('active')
    }
    
    
    
    if (modalContainer.classList.contains('active') === true) {
        modalTriggers.forEach(trigger => trigger.addEventListener('click', removeModal))
    }    
    
})  
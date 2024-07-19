const display_load = document.querySelector('.display-load')

export const loading = (activo) => {
    !activo ?
    display_load.classList.add('oculto')    
    : display_load.classList.remove('oculto') 
}
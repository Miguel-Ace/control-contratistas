import { loading } from "./display_load"
const toogle = document.querySelector('.toogle')
const menu = document.querySelector('.menu')
const contenedor = document.querySelector('.contenedor')
const contenido_left = document.querySelector('.left')
const icon_cabiar_catalogo = document.querySelector('.icon-cabiar-catalogo')
const detalle_setting = document.querySelector('.detalle-setting')
const catalogos = document.querySelectorAll('.catalogos a')
const btn_guardar = document.querySelector('.btn-guardar')
const btn_editar = document.querySelector('.btn-editar')

btn_guardar ?
btn_guardar.onclick = () => {
    loading(true)
} : ''

btn_editar ?
btn_editar.onclick = () => {
    loading(true)
} : ''

// Comprobar el estado del menú toggle
if (sessionStorage.getItem('menu_plegado') !== null) {
    if (parseInt(sessionStorage.getItem('menu_plegado'))) {
        contenedor.classList.add('reducir-catalogo')
    }else{
        contenedor.classList.remove('reducir-catalogo')
    }
}

// Menú toggle
toogle.onclick = () =>{
    const menu_plegado = sessionStorage.getItem('menu_plegado')
    contenedor.classList.toggle('reducir-catalogo')
    menu_plegado == null? sessionStorage.setItem('menu_plegado', 1) : sessionStorage.setItem('menu_plegado', parseInt(menu_plegado) ? 0 : 1)
}

// Cambiar la lista del catálogo
icon_cabiar_catalogo.onclick = () => {
    icon_cabiar_catalogo.querySelector('i').classList.toggle('activo')
    
    for (const item of catalogos) {
        if (item.classList.contains('desactivar')) {
            item.classList.remove('desactivar')
        }else{
            item.classList.add('desactivar')
        }
    }
}

// Mostrar settings
document.querySelector('.usuario').onclick = () => {
    detalle_setting.classList.toggle('activo')
    document.querySelector('.usuario ion-icon').classList.toggle('activo')
}

menu.onclick = () => {
    if (contenedor.classList.contains('reducir-catalogo')) {
        contenedor.classList.remove('reducir-catalogo')
    }

    contenido_left.classList.toggle('activo')
    menu.classList.toggle('activo')
}


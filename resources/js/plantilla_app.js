import { grid } from "./grid"
import { fun_fetch } from "./fetch"

const toogle = document.querySelector('.toogle')
const contenedor = document.querySelector('.contenedor')
const icon_cabiar_catalogo = document.querySelector('.icon-cabiar-catalogo')
const detalle_setting = document.querySelector('.detalle-setting')
const catalogos = document.querySelectorAll('.catalogos a')
const tabla = document.querySelector('.tabla')

if (sessionStorage.getItem('menu_plegado') !== null) {
    if (parseInt(sessionStorage.getItem('menu_plegado'))) {
        contenedor.classList.add('reducir-catalogo')
        tabla.classList.add('activo')
    }else{
        contenedor.classList.remove('reducir-catalogo')
    }
}

// Menú toggle
toogle.onclick = () =>{
    const menu_plegado = sessionStorage.getItem('menu_plegado')
    contenedor.classList.toggle('reducir-catalogo')
    menu_plegado == null? sessionStorage.setItem('menu_plegado', 1) : sessionStorage.setItem('menu_plegado', parseInt(menu_plegado) ? 0 : 1)
    tabla.classList.toggle('activo')
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


// Cambiar vistas
const view_form = document.querySelector('.view-form')
const view_list = document.querySelector('.view-list')
const form_crear = document.querySelector('.form-crear')
const detalle_registro = document.querySelector('.detalle-registro')

export const cambiar_a_form = () => {
    form_crear.classList.remove('desactivar')
    tabla.classList.add('desactivar')
    view_form ?
        view_form.classList.add('desactivar') 
    : ''
    view_list.classList.remove('desactivar')
    detalle_registro.classList.add('desactivar')
}

export const cambiar_a_view = () => {
    form_crear.classList.add('desactivar')
    tabla.classList.add('desactivar')
    view_form ?
        view_form.classList.add('desactivar')
    : ''
    view_list.classList.remove('desactivar')
    detalle_registro.classList.remove('desactivar')
}

view_form ?
view_form.onclick = () =>{
    cambiar_a_form()
} : ''

view_list.onclick = () =>{
    tabla.classList.remove('desactivar')
    form_crear.classList.add('desactivar')
    view_form ?
        view_form.classList.remove('desactivar')
    : ''
    view_list.classList.add('desactivar')
    detalle_registro.classList.add('desactivar')
}

// borrar un regístro
// window.addEventListener('click', e => {
//     if (e.target.classList.contains('btn-delete')) {
//         const id = e.target.getAttribute('data-id')
        
//         fun_fetch(`users/delete/${id}`,'','DELETE')
//         .then(respuesta => {
//             if (respuesta.ok) {
//                 Swal.fire({
//                     title: "Eliminado exitosamente",
//                     icon: "success",
//                     showConfirmButton: false,
//                     timer: 1500
//                 });
                
//                 setTimeout(() => {
//                     window.location.reload()
//                 }, 1000);
//             }else{
//                 Swal.fire({
//                     title: "No se pudo eliminar",
//                     icon: "error",
//                     showConfirmButton: false,
//                     timer: 1500
//                 })
//             }
//         })
//     }
// });
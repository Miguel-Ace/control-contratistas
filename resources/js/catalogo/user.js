import { loading } from "../display_load"
import { quitar_errores } from "../limpiar_errores";
const icon_cambiar = document.querySelector('.icon-cambiar')
const input_password = document.querySelector('#password')

quitar_errores()

// Ocultar o mostrar la contraseña
icon_cambiar ?
icon_cambiar.onclick = () => {
    if (icon_cambiar.classList.contains('fa-eye-slash')) {
        icon_cambiar.classList.replace('fa-eye-slash','fa-eye')
        input_password.setAttribute('type','text')
    }else{
        icon_cambiar.classList.replace('fa-eye','fa-eye-slash')
        input_password.setAttribute('type','password')
    }
} : ''

loading(false)
import { url, grid } from "../grid"
import { input } from "../componente/input"
import { campo } from "../componente/campo"
import { fun_fetch } from "../fetch"
import { loading } from "../display_load"
import { validar_datos } from "../validar_form"
import { cambiar_a_form, cambiar_a_view } from "../plantilla_app"

const btn_guardar = document.querySelector('.btn-guardar')
const btn_editar = document.querySelector('.btn-editar')

// Mostrar catálogo seleccionado
document.querySelector('.titulo').textContent = 'Tipo de documento'

// Grid js
const encabezado = [
    'Tipo de documento',
    {
        name: '-',
        formatter: (cell, row) => gridjs.html(`
            <i class="fa-regular fa-eye btn-ico-view btn-acciones" data-id="${row.cells[1].data}"></i>
            <i class="fa-solid fa-pen-to-square btn-ico-editar btn-acciones" data-id="${row.cells[1].data}"></i>
            <i class="fa-regular fa-square-minus btn-delete btn-acciones" data-id="${row.cells[1].data}"></i>
        `)
    }
]

const data = {
        url: `${url}/tipos_documentos`,
        then: data => data.map(item => 
        [
            item.tipo_documento,
            item.id
        ]
        )
    }

grid(encabezado,data)

// Mostrar los inputs
const view_form = document.querySelector('.view-form')
const datos = [
    ['tipo_documento','Tipo de documento','text']
]

view_form.addEventListener('click', () => {
    loading(true)
    document.querySelector('.contenedor-inputs').innerHTML = ''
    btn_guardar.classList.remove('desactivar')
    btn_editar.classList.add('desactivar')

    for (let i = 0; i < datos.length; i++) {
        input(datos[i][0],datos[i][1],datos[i][2],'','','',datos[i][3],datos[i][4])
    }

    loading(false)
})

// Validar formulario crear
btn_guardar.addEventListener('click', e => {
    loading(true)
    e.preventDefault()
    btn_guardar.disabled = true
    validar_datos('tipos_documentos','POST')

    loading(false)
})

// Validar formulario editar
btn_editar.addEventListener('click', e => {
    loading(true)
    e.preventDefault()
    btn_editar.disabled = true
    validar_datos(`tipos_documentos/update/${sessionStorage.getItem('id')}`,'PATCH')

    loading(false)
})


// Las acciones
window.addEventListener('click', e => {
    // editar
    if (e.target.classList.contains('btn-ico-editar')) {
        document.querySelector('.contenedor-inputs').innerHTML = ''
        loading(true)
        cambiar_a_form()
        btn_guardar.classList.add('desactivar')
        btn_editar.classList.remove('desactivar')

        for (let i = 0; i < datos.length; i++) {
            input(datos[i][0],datos[i][1],datos[i][2],true,e.target.getAttribute('data-id'),'tipos_documentos',datos[i][3],datos[i][4])
        }
        
        sessionStorage.setItem('id',e.target.getAttribute('data-id'))
    }

    // borrar
    if (e.target.classList.contains('btn-delete')) {
        const id = e.target.getAttribute('data-id')
        
        fun_fetch(`tipos_documentos/delete/${id}`,'','DELETE')
        .then(respuesta => {
            if (respuesta.ok) {
                Swal.fire({
                    title: "Eliminado exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                });
                
                setTimeout(() => {
                    window.location.reload()
                }, 1000);
            }else{
                Swal.fire({
                    title: "No se pudo eliminar",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    }

    // ver
    if (e.target.classList.contains('btn-ico-view')){
        loading(true)
        document.querySelector('.contenedor-detalle-registro').innerHTML = ''
        cambiar_a_view()
        fun_fetch(`tipos_documentos_x_id/${e.target.getAttribute('data-id')}`,'','GET')
        .then(res => res.json())
        .then(data => {
            for (let i = 0; i < datos.length; i++) {
                if (datos[i][2] == 'select') {
                    campo(datos[i][1],data[datos[i][3]][datos[i][4]])
                }else{
                    campo(datos[i][1],data[datos[i][0]])
                }
            }
            loading(false)
        })

    }
});
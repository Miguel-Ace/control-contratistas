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
document.querySelector('.titulo').textContent = 'Contratistas / Empleados'

// Grid js
const encabezado = [
    'Contratista',
    'Nombres',
    'Apellidos',
    'Cédula',
    'Tipo de cédula',
    'Teléfono',
    'Email',
    'Direccion',
    'Número de seguro',
    {
        name: '-',
        formatter: (cell, row) => gridjs.html(`
            <i class="fa-regular fa-eye btn-ico-view btn-acciones" data-id="${row.cells[6].data}"></i>
            <i class="fa-solid fa-pen-to-square btn-ico-editar btn-acciones" data-id="${row.cells[6].data}"></i>
            <i class="fa-regular fa-square-minus btn-delete btn-acciones" data-id="${row.cells[6].data}"></i>
        `)
    }
]

const data = {
    url: `${url}/empleados`,
    then: data => data
        .filter(item => item.contratistas.id == sessionStorage.getItem('id'))
        .map(item => [
            item.contratistas.nombre_contratista,
            item.nombres,
            item.apellidos,
            item.cedula,
            item.tipos_cedulas.tipo_cedula,
            item.telefono,
            item.email,
            item.direccion,
            item.num_seguro,
            item.id
        ])
}

grid(encabezado,data)

// Mostrar los inputs
const view_form = document.querySelector('.view-form')
const datos = [
    ['id_contratista','Contratista','select','contratistas','nombre_contratista'],
    ['nombres','Nombres','text'],
    ['apellidos','Apellidos','text'],
    ['cedula','Cédula','text'],
    ['id_tipo_cedula','Tipo de cédula','select','tipos_cedulas','tipo_cedula'],
    ['telefono','Teléfono','tel'],
    ['email','Email','email'],
    ['direccion','Direccion','text'],
    ['num_seguro','Número de seguro','number'],
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
    validar_datos('empleados','POST')

    loading(false)
})

// Validar formulario editar
btn_editar.addEventListener('click', e => {
    loading(true)
    e.preventDefault()
    btn_editar.disabled = true
    validar_datos(`empleados/update/${sessionStorage.getItem('id')}`,'PATCH')

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
            input(datos[i][0],datos[i][1],datos[i][2],true,e.target.getAttribute('data-id'),'empleados',datos[i][3],datos[i][4])
        }
        
        sessionStorage.setItem('id',e.target.getAttribute('data-id'))
    }

    // borrar
    if (e.target.classList.contains('btn-delete')) {
        const id = e.target.getAttribute('data-id')
        
        fun_fetch(`empleados/delete/${id}`,'','DELETE')
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
        fun_fetch(`empleados_x_id/${e.target.getAttribute('data-id')}`,'','GET')
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
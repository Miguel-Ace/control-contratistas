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
document.querySelector('.titulo').textContent = 'Contratistas'
// Grid js
const encabezado = [
    {
        name: '-',
        formatter: (cell, row) => gridjs.html(`
            <i class="fa-solid fa-hammer btn-ico-change btn-acciones" data-id="${row.cells[0].data}" url="/contratistas/equipos"></i>
            <i class="fa-solid fa-user btn-ico-change btn-acciones" data-id="${row.cells[0].data}" url="/contratistas/empleados"></i>
            <i class="fa-solid fa-car btn-ico-change btn-acciones" data-id="${row.cells[0].data}" url="/contratistas/vehiculos"></i>
            <i class="fa-solid fa-book btn-ico-change btn-acciones" data-id="${row.cells[0].data}" url="/contratistas/documentos"></i>
            <i class="fa-regular fa-eye btn-ico-view btn-acciones" data-id="${row.cells[0].data}"></i>
            <i class="fa-solid fa-pen-to-square btn-ico-editar btn-acciones" data-id="${row.cells[0].data}"></i>

            ${
                sessionStorage.getItem('rol') == 1 ?
                row.cells[1].data == 'Si'?
                `<i class="fa-solid fa-check btn-acciones btn-activo activo" data-id="${row.cells[0].data}"></i>`
                :
                `<i class="fa-solid fa-x btn-acciones btn-activo" data-id="${row.cells[0].data}"></i>`
                : ''
            }
        `)
    },
    'Activo',
    'Nombre de empresa',
    'Tipo de cedula',
    'Teléfono de empresa',
    'Cédula de la empresa',
    'Dirección de empresa',
    'Barrio',
    'Canton',
    'Provincia',
    'Página web',
    'Nombre del contratista',
    'Cédula del contratista',
    'Teléfono del contratista',
    'Correo del contratista',
    'Documento INS',
    'Documento CCSS',
    'Fecha de inicio',
    'Fecha de fin',
]

const data = {
        url: `${url}/contratistas`,
        then: data => data
        .filter(item => item.id_user == sessionStorage.getItem('user'))
        .map(item => [
            item.id,
            item.activo ? 'Si' : 'No',
            item.nombre_empresa,
            item.tipos_cedulas.tipo_cedula,
            item.telefono_empresa,
            item.cedula_empresa,
            item.direccion_empresa,
            item.barrio,
            item.cantones.canton,
            item.provincias.provincia,
            item.web,
            item.nombre_contratista,
            item.cedula_contratista,
            item.telefono_contratista,
            item.correo_contratista,
            item.documento_ins,
            item.documento_ccss,
            item.fecha_ini,
            item.fecha_fin
        ])
    }

grid(encabezado,data)

// Mostrar los inputs
const view_form = document.querySelector('.view-form')

// if (sessionStorage.getItem('rol') == 1) {
//     view_form.classList.add('desactivar')
// }else{
//     fun_fetch(`contratistas_x_id/${sessionStorage.getItem('user')}`,'','GET')
//     .then(respuesta => {
//         if (respuesta.ok) {
//             view_form.classList.add('desactivar')
//         }
//     })
// }

const datos = [
    ['nombre_empresa','Nombre de empresa','text'],
    ['id_tipo_cedula','Tipo de cedula','select','tipos_cedulas','tipo_cedula'],
    ['telefono_empresa','Teléfono de empresa','tel'],
    ['cedula_empresa','Cédula de la empresa','text'],
    ['direccion_empresa','Dirección de empresa','text'],
    ['barrio','Barrio','text'],
    ['id_canton','Canton','select','cantones','canton'],
    ['id_provincia','Provincia','select','provincias','provincia'], //solo para mostrar
    ['web','Página web','text'],
    ['nombre_contratista','Nombre del contratista','text'],
    ['cedula_contratista','Cédula del contratista','text'],
    ['telefono_contratista','Teléfono del contratista','tel'],
    ['correo_contratista','Correo del contratista','email'],
    ['documento_ins','Documento INS','file'],
    ['documento_ccss','Documento CCSS','file'],
    ['fecha_ini','Fecha de inicio','date'],
    ['fecha_fin','Fecha de fin','date'],
]

view_form ?
view_form.addEventListener('click', () => {
    loading(true)
    document.querySelector('.contenedor-inputs').innerHTML = ''
    btn_guardar.classList.remove('desactivar')
    btn_editar.classList.add('desactivar')

    for (let i = 0; i < datos.length; i++) {
        input(datos[i][0],datos[i][1],datos[i][2],'','','',datos[i][3],datos[i][4])
    }

    loading(false)
}) : ''

// Validar formulario crear
btn_guardar.addEventListener('click', e => {
    loading(true)
    e.preventDefault()
    btn_guardar.disabled = true
    validar_datos('contratistas','POST')

    loading(false)
})

// Validar formulario editar
btn_editar.addEventListener('click', e => {
    loading(true)
    e.preventDefault()
    btn_editar.disabled = true
    validar_datos(`contratistas/update/${sessionStorage.getItem('id')}`,'PATCH')

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
            input(datos[i][0],datos[i][1],datos[i][2],true,e.target.getAttribute('data-id'),'contratistas',datos[i][3],datos[i][4])
        }
        
        sessionStorage.setItem('id',e.target.getAttribute('data-id'))
    }

    // borrar
    if (e.target.classList.contains('btn-delete')) {
        const id = e.target.getAttribute('data-id')
        
        fun_fetch(`contratistas/delete/${id}`,'','DELETE')
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
        fun_fetch(`contratistas_x_id/${e.target.getAttribute('data-id')}`,'','GET')
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

    // Otra pantalla
    if (e.target.classList.contains('btn-ico-change')){
        sessionStorage.setItem('id', e.target.getAttribute('data-id'))
        sessionStorage.setItem('campo', 'id_contratista')
        const a = document.createElement('a')
        a.setAttribute('href',e.target.getAttribute('url'))
        a.click()
    }
    
    // Activar contratista
    if (e.target.classList.contains('btn-activo')){
        fun_fetch(`contratistas/update/activo/${e.target.getAttribute('data-id')}`,'','PATCH')
        .then(respuesta => {
            if (respuesta.ok) {
                Swal.fire({
                    title: "Estado cabiado exitosamente",
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
    
});
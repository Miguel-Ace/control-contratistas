import { fun_fetch } from "../fetch"
import { loading } from "../display_load"

const contenedor_inputs = document.querySelector('.contenedor-inputs')

// Crear el input
export const input = (attLabel,nameLabel,typeInput, editar = false, id = 0, campo = '' , get_select = '', nombre_select = '') => {
    const inputsExcept = attLabel != 'id_provincia' && attLabel != 'id_contratista';

    if (inputsExcept) {
        const div = document.createElement('div')
        div.classList.add('inputs')
        const div_encabezado_input = document.createElement('div')
        div_encabezado_input.classList.add('encabezado-input')
        const label = document.createElement('label')
        label.setAttribute('for', attLabel)
        label.textContent = nameLabel
        const p = document.createElement('p')
        p.classList.add('error-input')
        
        const select = document.createElement('select')
        const input = document.createElement('input')
        
        if (typeInput == 'select') {
            select.setAttribute('class', 'input')
            select.setAttribute('id', attLabel)
            fun_fetch(get_select,'','GET')
            .then(res => res.json())
            .then(data => {
                for (const item of data) {
                    const option = document.createElement('option')
                    option.value = item.id
                    option.textContent = item[nombre_select]
                    select.appendChild(option)
                }
            })
        }else{
            input.setAttribute('type', typeInput)
            input.setAttribute('class', 'input')
            input.setAttribute('id', attLabel)
            input.setAttribute('autocomplete', 'current')
        }
    
        // poner valor a los campos si es editar
        if (editar) {
            setTimeout(() => {
                fun_fetch(`${campo}_x_id_x_campo/${id}/${attLabel}`,'','GET')
                .then(res => res.json())
                .then(data => {
                    if (data.campo[attLabel]) {
                        if (typeInput != 'file') {
                            if (typeInput == 'select') {
                                select.value = data.campo[attLabel]
                            }else{
                                input.value = data.campo[attLabel]
                            }
                        }
                    }
        
                    loading(false)
                })
            }, 1000);
        }
    
        div_encabezado_input.appendChild(label)
        div_encabezado_input.appendChild(p)
        div.appendChild(div_encabezado_input)
        typeInput == 'select' ? div.appendChild(select) : div.appendChild(input)
        contenedor_inputs.appendChild(div)
    }
}
import { fun_fetch } from "./fetch"

export const validar_datos = (complemento_url,verbo_http) => {
    const inputs = document.querySelectorAll('.inputs')
    const btn_guardar = document.querySelector('.btn-guardar')
    const btn_editar = document.querySelector('.btn-editar')
    let countCampos = inputs.length
    let datos = {}

    // Por si existe un catálo que pertenezca a otro se agrega el campo que los une
    if (sessionStorage.getItem('campo')) {
        datos = { [sessionStorage.getItem('campo')]:sessionStorage.getItem('id')}
    }

    for (const item of inputs) {
        const texto_error = item.querySelector('.encabezado-input p')
        const input = item.querySelector('.input')
        const name = input.id

        const inputsExcept = name != 'observaciones' && name != 'notas' && name != 'observacion';
        
        if (input.value == '' && inputsExcept) {
            texto_error.textContent = 'Llena este campo'
            input.classList.add('error')

            setTimeout(() => {
                texto_error.textContent = ''
                input.classList.remove('error')
            }, 2000);
            
            countCampos = 0
        }else{
            datos = {...datos, [name]:input.value}
        }
    }

    if (countCampos) {
        // Insertar los datos
        fun_fetch(complemento_url,datos,verbo_http)

        // Mensaje de ok
        .then(respuesta => {
            if (respuesta.ok) {
                Swal.fire({
                    title: "Agregado exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                });
                
                setTimeout(() => {
                    window.location.reload()
                }, 1000);
            }else{
                Swal.fire({
                    title: "No se agregó",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                });

                // Limpiando los inputs
                for (const item of inputs) {
                    const input = item.querySelector('.input').value = ''
                }
            }
        })
    }

    btn_guardar.disabled = false
    btn_editar.disabled = false
}
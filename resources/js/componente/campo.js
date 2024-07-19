const contenedor_detalle_registro = document.querySelector('.contenedor-detalle-registro')

export const campo = (nClave,nValor) => {
    const div = document.createElement('div')
    div.classList.add('campos')
    const pNameCampo = document.createElement('p')
    pNameCampo.classList.add('campo')
    pNameCampo.textContent = `${nClave} :`
    const pValueCampo = document.createElement('p')
    pValueCampo.classList.add('valor')
    pValueCampo.textContent = nValor

    div.appendChild(pNameCampo)
    div.appendChild(pValueCampo)
    contenedor_detalle_registro.appendChild(div)
}
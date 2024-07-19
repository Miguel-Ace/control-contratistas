import { url } from "./grid"

export const fun_fetch = async (complemento_url, datos = '', metodo) => {
    const direccion = `${url}/${complemento_url}`;

    let option = {
        method: metodo,
        headers: {
            'content-type': 'application/json',
        }
    }

    if (metodo == 'POST' || metodo == 'PUT' || metodo == 'PATCH') {
        option = {...option, body: JSON.stringify(datos)}
    }
    
    return await fetch(direccion, option)
}
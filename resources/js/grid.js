import { loading } from "./display_load"

const local = 'http://127.0.0.1:8000/api'
const server = 'http://161.22.45.66/api'
export const url = local

export function grid(encabezado,data) {
    new gridjs.Grid({
        search: true,
        // sort: true,
        resizable: true,
        pagination: {
            limit: 5,
        },
        language: {
            'search': {
              'placeholder': '🔍 Buscar...'
            },
            'alert':{

            },
            'pagination': {
              'previous': '⬅',
              'next': '➡',
              'showing': 'Mostrando ',
              'results': () => 'Regístros'
            },
            loading: 'Cargando...',
            noRecordsFound: '-',
            error: 'Ocurrió un error al cargar los datos'
        },
        columns: encabezado,
        server: data,
        style: {
            th: {
              'background-color': '#434343',
              'color': 'white',
            },
            table: {
            },
          }
    }).render(document.getElementById('wrapper'))

    loading(false)
}
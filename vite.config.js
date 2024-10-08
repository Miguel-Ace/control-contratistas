import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: 
            [
                'resources/css/display_load.css',
                'resources/css/general.css',
                'resources/css/plantilla_app.css',
                'resources/css/plantilla_auth.css',
                'resources/css/catalogo/user.css',
                'resources/css/catalogo/contratista.css',
                'resources/js/plantilla_app.js',
                'resources/js/display_load.js',
                'resources/js/limpiar_errores.js',
                'resources/js/catalogo/user.js',
                'resources/js/catalogo/contratista.js',
                'resources/js/catalogo/tipo_equipo.js',
                'resources/js/catalogo/tipo_documento.js',
                'resources/js/catalogo/tipo_cedula.js',
                'resources/js/catalogo/equipo.js',
                'resources/js/catalogo/documento.js',
                'resources/js/catalogo/vehiculo.js',
                'resources/js/catalogo/empleado.js',
            ],
            refresh: true,
        }),
    ],
});

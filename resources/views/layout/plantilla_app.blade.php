<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control-Contratistas</title>
    @vite(['resources/css/display_load.css','resources/css/general.css','resources/css/plantilla_app.css','resources/js/plantilla_app.js','resources/js/grid.js'])
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
</head>
<body>
    <div class="display-load">
        <div class="cajita">
            <span class="s1"></span>
            <span class="s2"></span>
            <span class="s3"></span>
        </div>
    </div>

    <div class="contenedor">
        <div class="left">
            <div class="toogle"></div>
            <div class="catalogos">
                <a href="{{url('/contratistas')}}" class="a">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <span class="nombre-catalogo">Contratistas</span>
                </a>

                @role('admin')
                <a href="{{url('/tipos_cedulas')}}" class="a">
                    <ion-icon name="card-outline"></ion-icon>
                    <span class="nombre-catalogo">Tipo de cédula</span>
                </a>

                <a href="{{url('/tipos_documentos')}}" class="a">
                    <ion-icon name="documents-outline"></ion-icon>
                    <span class="nombre-catalogo">Tipo de documento</span>
                </a>

                <a href="{{url('/tipos_equipos')}}" class="a">
                    <ion-icon name="briefcase-outline"></ion-icon>
                    <span class="nombre-catalogo">Tipo de equipo</span>
                </a>
                @endrole
            </div>
            <div class="icon-cabiar-catalogo">
                <i class="fa-solid fa-arrows-rotate"></i>
            </div>
        </div>

        <div class="right">
            <div class="encabezado">
                <div class="logo">
                    <img src="https://beesys.net/beesy2023/wp-content/uploads/2023/07/logo-beesys-2021-1.png" alt="">
                </div>

                <div class="settings">
                    <div class="usuario">
                        <p>{{auth()->user()->name}}</p>
                        <ion-icon name="caret-back-outline"></ion-icon>
                    </div>

                    <div class="detalle-setting">
                        @role('admin')
                        <a href="{{route('user')}}">Usuarios</a>
                        <a href="#">Roles y Permisos</a>
                        @endrole
                        <a href="{{route('logout')}}">Cerrar sesión</a>
                    </div>
                </div>
            </div>

            <div class="informacion">
                <div class="encabezado-tabla">
                    <p class="titulo">---</p>
                    @role('admin')
                    <button class="btn-cambio-vista view-form btn">{{-- <i class="fa-solid fa-plus"></i> Nuevo regístro --}}</button>
                        <script>
                            setTimeout(() => {
                            if (document.querySelector('.gridjs-tr')) {
                                    `<i class="fa-solid fa-plus"></i> Nuevo regístro`
                                }
                            }, 1000);
                        </script>
                    @endrole
                    <button class="btn-cambio-vista view-list btn desactivar"><i class="fa-solid fa-eye"></i> Ver Lista</button>
                </div>

                <div class="form-crear desactivar">
                    <form>
                        <div class="contenedor-inputs"></div>

                        <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                        <button class="btn btn-editar desactivar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
                    </form>
                </div>

                <div class="tabla">
                    <div id="wrapper"></div>
                </div>

                <div class="detalle-registro desactivar">
                    <div class="contenedor-detalle-registro"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- {{$user->hasRole('admin') ? 'si' : 'no'}} --}}
    <script>
        sessionStorage.setItem('user',{{auth()->user()->id}})
        sessionStorage.setItem('rol',{{$user->hasRole('admin') ? 1 : 2}})
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
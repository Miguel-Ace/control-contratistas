<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control-Contratistas</title>
    @vite(['resources/css/display_load.css','resources/css/general.css','resources/css/plantilla_app.css','resources/js/plantilla_app.js'])
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
</head>
<body>
    @if(session('mensaje'))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "{{ session('mensaje') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif

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
                        <a href="{{route('user')}}">
                            @role('admin')
                                Usuarios
                            @elserole('contratista')
                                Usuario
                            @endrole
                        </a>
                        <a href="{{route('logout')}}">Cerrar sesión</a>
                    </div>
                </div>
            </div>

            <div class="informacion">
                @yield('informacion')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
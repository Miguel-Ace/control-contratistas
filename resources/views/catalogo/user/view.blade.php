@vite(['resources/js/catalogo/user.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">
            @role('admin')
                Usuarios
            @elserole('contratista')
                Usuario
            @endrole
        </p>
        
        <a href="{{url('/user')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Nombre:</p>
                    <p class="valor">{{$dato->name}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Email:</p>
                    <p class="valor">{{$dato->email}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
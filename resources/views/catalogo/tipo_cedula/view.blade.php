@vite(['resources/js/catalogo/tipo_cedula.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de cédulas</p>
        
        <a href="{{url('/tipos_cedulas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Tipo de cédula:</p>
                    <p class="valor">{{$dato->tipo_cedula}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@vite(['resources/js/catalogo/equipo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Equipo</p>
        
        <a href="{{url('/contratistas/equipo/'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Contratista:</p>
                    <p class="valor">{{$dato->contratistas->nombre_contratista}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Tipo de Equipo:</p>
                    <p class="valor">{{$dato->tipos_equipos->tipo_equipo}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Equipo:</p>
                    <p class="valor">{{$dato->equipo}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Número de Serie:</p>
                    <p class="valor">{{$dato->numero_serie}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
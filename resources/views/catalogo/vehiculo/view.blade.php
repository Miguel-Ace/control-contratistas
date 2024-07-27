@vite(['resources/js/catalogo/vehiculo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Vehiculo</p>
        
        <a href="{{url('/contratistas/vehiculo/'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
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
                    <p class="clave">Marca:</p>
                    <p class="valor">{{$dato->marca}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Modelo:</p>
                    <p class="valor">{{$dato->modelo}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Color:</p>
                    <p class="valor">{{$dato->color}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Placa:</p>
                    <p class="valor">{{$dato->placa}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
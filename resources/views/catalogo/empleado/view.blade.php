@vite(['resources/js/catalogo/contratista.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Empleado</p>
        
        <a href="{{url('/contratistas/empleados/'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
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
                    <p class="clave">Nombres:</p>
                    <p class="valor">{{$dato->nombres}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Apellidos:</p>
                    <p class="valor">{{$dato->apellidos}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Cédula:</p>
                    <p class="valor">{{$dato->cedula}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Tipo de Cédula:</p>
                    <p class="valor">{{$dato->tipos_cedulas->tipo_cedula}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Teléfono:</p>
                    <p class="valor">{{$dato->telefono}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Email:</p>
                    <p class="valor">{{$dato->email}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Dirección:</p>
                    <p class="valor">{{$dato->direccion}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Número del Seguro:</p>
                    <p class="valor">{{$dato->num_seguro}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
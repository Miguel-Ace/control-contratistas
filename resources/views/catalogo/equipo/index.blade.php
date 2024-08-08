@vite(['resources/js/catalogo/equipo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/contratistas')}}">Contratista</a> : {{$nombre_contratista}} / Equipo</p>

        @role('contratista')
        <a href="{{url('/contratistas/equipo/create/'.$contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-plus"></i>
            Crear Nuevo
        </a>
        @endrole
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr>
                    <td>-</td>
                    <td>Tipo de equipo</td>
                    <td>Equipo</td>
                    <td>Número de serie</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('contratista')
                            <a href="{{url('/contratistas/equipo/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/contratistas/equipo/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->tipos_equipos->tipo_equipo}}</td>
                        <td>{{$dato->equipo}}</td>
                        <td>{{$dato->numero_serie}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
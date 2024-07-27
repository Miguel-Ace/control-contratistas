@vite(['resources/js/catalogo/tipo_equipo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de equipo</p>

        <a href="{{url('/tipos_equipos/create')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-plus"></i>
            Crear Nuevo
        </a>
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr>
                    <td>-</td>
                    <td>Tipo de equipo</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin')
                            <a href="{{url('/tipos_equipos/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            <a href="{{url('/tipos_equipos/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                            @endrole
                        </td>
                        <td>{{$dato->tipo_equipo}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
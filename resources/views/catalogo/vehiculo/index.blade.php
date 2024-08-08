@vite(['resources/js/catalogo/vehiculo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/contratistas')}}">Contratista</a> : {{$nombre_contratista}} / Vehiculo</p>

        @role('contratista')
        <a href="{{url('/contratistas/vehiculo/create/'.$contratista)}}" class="btn-cambio-vista btn">
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
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>Color</td>
                    <td>Placa</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('contratista')
                            <a href="{{url('/contratistas/vehiculo/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/contratistas/vehiculo/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->marca}}</td>
                        <td>{{$dato->modelo}}</td>
                        <td>{{$dato->color}}</td>
                        <td>{{$dato->placa}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@vite(['resources/js/catalogo/user.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Usuarios</p>

        <a href="{{url('/user/create')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-plus"></i>
            Crear Nuevo
        </a>
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr>
                    <td>-</td>
                    <td>Nombre</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            {{-- @role('admin')
                            @endrole --}}
                            <a href="{{url('/user/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            {{-- <a href="{{url('/user/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a> --}}
                        </td>
                        <td>{{$dato->name}}</td>
                        <td>{{$dato->email}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@vite(['resources/js/catalogo/user.js','resources/css/catalogo/user.css'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">
            @role('admin')
                Usuarios
            @else('contratista')
                Usuario
            @endrole
        </p>

        @role('admin')
            <a href="{{url('/user/create')}}" class="btn-cambio-vista btn">
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
                    <td>Nombre</td>
                    <td>Email</td>
                    @role('admin')
                    <td>Rol</td>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @if ($dato->id == auth()->user()->id)
                            <a href="{{url('/user/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endif
                            <a href="{{url('/user/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->name}}</td>
                        <td>{{$dato->email}}</td>
                        @role('admin')
                            <td>
                                <form action="{{url('/rol'.'/'.$dato->id)}}" method="post" class="form-rol">
                                    @csrf
                                    @foreach ($roles as $rol)
                                        <button type="submit" class="btn-rol {{$rol->name == $dato->getRoleNames()[0] ? 'activo' : ''}}" name="rol" value="{{ $rol->name }}">{{ $rol->name }}</button>
                                    @endforeach
                                </form>
                            </td>
                        @endrole
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
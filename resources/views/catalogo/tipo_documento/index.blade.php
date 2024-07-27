@vite(['resources/js/catalogo/tipo_documento.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de documentos</p>

        <a href="{{url('/tipos_documentos/create')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-plus"></i>
            Crear Nuevo
        </a>
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr>
                    <td>-</td>
                    <td>Tipo de documento</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin')
                            <a href="{{url('/tipos_documentos/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            <a href="{{url('/tipos_documentos/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                            @endrole
                        </td>
                        <td>{{$dato->tipo_documento}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
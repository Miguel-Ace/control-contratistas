@vite(['resources/js/catalogo/documento.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/contratistas')}}">Contratista</a> : {{$nombre_contratista}} / Documento</p>

        @role('contratista')
        <a href="{{url('/contratistas/documento/create/'.$contratista)}}" class="btn-cambio-vista btn">
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
                    <td>Empleado</td>
                    <td>Vehiculo</td>
                    <td>Fecha de vencimiento</td>
                    <td>Observación</td>
                    <td>Tipo de documento</td>
                    <td>Número de documento</td>
                    <td>Attach</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('contratista')
                            <a href="{{url('/contratistas/documento/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/contratistas/documento/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->empleados->nombres}} {{$dato->empleados->apellidos}}</td>
                        <td>{{$dato->vehiculos->marca}} {{$dato->vehiculos->modelo}} {{$dato->vehiculos->color}}</td>
                        <td>{{$dato->fecha_vencimiento}}</td>
                        <td>{{$dato->observacion ? $dato->observacion : '-'}}</td>
                        <td>{{$dato->tipos_documentos->tipo_documento}}</td>
                        <td>{{$dato->num_documento}}</td>
                        <td>
                            @if (Storage::disk('public')->exists('/documentos'.'/'.$dato->id.'/'.$dato->attach))
                                <a href="{{asset('storage').'/documentos'.'/'.$dato->id.'/'.$dato->attach}}" class="document">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </a>
                            @else
                                No existe documento
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
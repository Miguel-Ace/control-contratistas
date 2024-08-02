@vite(['resources/js/catalogo/contratista.js','resources/css/catalogo/contratista.css'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista</p>

        @role('contratista')
            @if ($pasar)
                <a href="{{url('/contratistas/create')}}" class="btn-cambio-vista btn">
                    <i class="fa-solid fa-plus"></i>
                    Crear Nuevo
                </a>
            @endif
        @endrole
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr>
                    <td>-</td>
                    <td>Activo</td>
                    <td>Empresa</td>
                    <td>Tipo de cédula</td>
                    <td>Teléfono de la empresa</td>
                    <td>Cédula de la empresa</td>
                    <td>Dirección de la empresa</td>
                    <td>Barrio</td>
                    <td>Cantón</td>
                    <td>Web</td>
                    <td>Contratista</td>
                    <td>Cédula del contratista</td>
                    <td>Teléfono del contratista</td>
                    <td>Correo del contratista</td>
                    <td>Documento INS</td>
                    <td>Documento CCSS</td>
                    <td>Fecha inicio</td>
                    <td>Fecha fin</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('contratista')
                            <a href="{{url('/contratistas/equipo/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-hammer btn-ico-change"></i></a>
                            <a href="{{url('/contratistas/documento/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-book btn-ico-change"></i></a>
                            <a href="{{url('/contratistas/vehiculo/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-car btn-ico-change"></i></a>
                            <a href="{{url('/contratistas/empleados/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-user btn-ico-change"></i></a>
                            <a href="{{url('/contratistas/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/contratistas/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>
                            @role('admin')
                            <form action="{{url('/contratistas/activo'.'/'.$dato->id)}}" method="post" class="form-activo">
                                @csrf
                                <button type="submit" class="btn-activo {{$dato->activo ? 'activo' : ''}}" name="activo" value="{{ $dato->activo }}">{{$dato->activo ? 'Si' : 'No'}}</button>
                            </form>
                            @else
                            {{$dato->activo ? 'Si' : 'No'}}
                            @endrole
                        </td>
                        <td>{{$dato->nombre_empresa}}</td>
                        <td>{{$dato->tipos_cedulas->tipo_cedula}}</td>
                        <td>{{$dato->telefono_empresa}}</td>
                        <td>{{$dato->cedula_empresa}}</td>
                        <td>{{$dato->direccion_empresa}}</td>
                        <td>{{$dato->barrio}}</td>
                        <td>{{$dato->cantones->canton}}</td>
                        <td>{{$dato->web}}</td>
                        <td>{{$dato->nombre_contratista}}</td>
                        <td>{{$dato->cedula_contratista}}</td>
                        <td>{{$dato->telefono_contratista}}</td>
                        <td>{{$dato->correo_contratista}}</td>
                        {{-- <td>{{$dato->documento_ins}}</td> --}}
                        <td>
                            @if (Storage::disk('public')->exists('/documentos_contratistas'.'/'.$dato->id.'/'.$dato->documento_ins))
                                <a href="{{asset('storage').'/documentos_contratistas'.'/'.$dato->id.'/'.$dato->documento_ins}}" class="document">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </a>
                            @else
                                No existe documento
                            @endif
                        </td>
                        <td>
                            @if (Storage::disk('public')->exists('/documentos_contratistas'.'/'.$dato->id.'/'.$dato->documento_ccss))
                                <a href="{{asset('storage').'/documentos_contratistas'.'/'.$dato->id.'/'.$dato->documento_ccss}}" class="document">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </a>
                            @else
                                No existe documento
                            @endif
                        </td>
                        <td>{{$dato->fecha_ini}}</td>
                        <td>{{$dato->fecha_fin}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
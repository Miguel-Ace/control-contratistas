@vite(['resources/js/catalogo/empleado.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/contratistas')}}">Contratista</a> : {{$nombre_contratista}} / Empleado</p>

        @role('contratista')
        <a href="{{url('/contratistas/empleados/create/'.$contratista)}}" class="btn-cambio-vista btn">
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
                    <td>Nombre completo</td>
                    <td>Cédula</td>
                    <td>Tipo de cédula</td>
                    <td>Teléfono</td>
                    <td>Email</td>
                    <td>Dirección</td>
                    <td>Numero del seguro</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('contratista')
                            <a href="{{url('/contratistas/empleados/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/contratistas/empleados/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->nombres}} {{$dato->apellidos}}</td>
                        <td>{{$dato->cedula}}</td>
                        <td>{{$dato->tipos_cedulas->tipo_cedula}}</td>
                        <td>{{$dato->telefono}}</td>
                        <td>{{$dato->email}}</td>
                        <td>{{$dato->direccion}}</td>
                        <td>{{$dato->num_seguro}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
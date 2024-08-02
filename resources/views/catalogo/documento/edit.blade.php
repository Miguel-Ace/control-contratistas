@vite(['resources/js/catalogo/documento.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Documento</p>

        <a href="{{url('/contratistas/documento/'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/contratistas/documento/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_empleado" class="encabezado-input">Empleado</label>
                    <select class="input" name="id_empleado" id="id_empleado">
                        @foreach ($empleados as $empleado)
                            <option value="{{$empleado->id}}" {{ $dato->id_empleado == $empleado->id ? 'selected' : '' }}>{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_vehiculo" class="encabezado-input">Vehículo</label>
                    <select class="input" name="id_vehiculo" id="id_vehiculo">
                        @foreach ($vehiculos as $vehiculo)
                            <option value="{{$vehiculo->id}}" {{ $dato->id_vehiculo == $vehiculo->id ? 'selected' : '' }}>{{$vehiculo->marca}} {{$vehiculo->modelo}} {{$vehiculo->color}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="fecha_vencimiento" class="encabezado-input">Fecha de Vencimiento</label>
                    <input type="date" class="input" name="fecha_vencimiento" id="fecha_vencimiento" value="{{$dato->fecha_vencimiento}}">
                </div>
                
                <div class="inputs">
                    <label for="observacion" class="encabezado-input">Observación</label>
                    <textarea class="input" name="observacion" id="observacion">{{$dato->observacion}}</textarea>
                </div>
                
                <div class="inputs">
                    <label for="id_tipo_documentos" class="encabezado-input">Tipo de documento</label>
                    <select class="input" name="id_tipo_documentos" id="id_tipo_documentos">
                        @foreach ($tipos_documentos as $tipo_documento)
                            <option value="{{$tipo_documento->id}}" {{ $dato->id_tipo_documentos == $tipo_documento->id ? 'selected' : '' }}>{{$tipo_documento->tipo_documento}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="inputs">
                    <label for="attach" class="encabezado-input">Adjunto</label>
                    <input type="file" class="input" name="attach" id="attach">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection
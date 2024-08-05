@vite(['resources/js/catalogo/documento.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Documento</p>

        <a href="{{url('/contratistas/documento/'.$contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/contratistas/documento/'.$contratista)}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_empleado" class="encabezado-input">Empleado</label>
                    <select class="input @error('id_empleado') error @enderror" name="id_empleado" id="id_empleado">
                        @foreach ($empleados as $empleado)
                            <option value="{{$empleado->id}}" {{ old('id_empleado') == $empleado->id ? 'selected' : '' }}>{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_vehiculo" class="encabezado-input">Vehículo</label>
                    <select class="input @error('id_vehiculo') error @enderror" name="id_vehiculo" id="id_vehiculo">
                        @foreach ($vehiculos as $vehiculo)
                            <option value="{{$vehiculo->id}}" {{ old('id_vehiculo') == $vehiculo->id ? 'selected' : '' }}>{{$vehiculo->marca}} {{$vehiculo->modelo}} {{$vehiculo->color}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="fecha_vencimiento" class="encabezado-input">Fecha de Vencimiento</label>
                    <input type="date" class="input @error('fecha_vencimiento') error @enderror" name="fecha_vencimiento" id="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}">
                </div>
                
                <div class="inputs">
                    <label for="observacion" class="encabezado-input">Observación</label>
                    <textarea class="input @error('observacion') error @enderror" name="observacion" id="observacion">{{ old('observacion') }}</textarea>
                </div>
                
                <div class="inputs">
                    <label for="id_tipo_documentos" class="encabezado-input">Tipo de documento</label>
                    <select class="input @error('id_vehiculo') error @enderror" name="id_tipo_documentos" id="id_tipo_documentos">
                        @foreach ($tipos_documentos as $tipo_documento)
                            <option value="{{$tipo_documento->id}}" {{ old('id_tipo_documentos') == $tipo_documento->id ? 'selected' : '' }}>{{$tipo_documento->tipo_documento}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="inputs">
                    <label for="num_documento" class="encabezado-input">Número de documento</label>
                    <input type="text" class="input @error('num_documento') error @enderror" name="num_documento" id="num_documento">
                </div>

                <div class="inputs">
                    <label for="attach" class="encabezado-input">Adjunto</label>
                    <input type="file" class="input @error('attach') error @enderror" name="attach" id="attach">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection
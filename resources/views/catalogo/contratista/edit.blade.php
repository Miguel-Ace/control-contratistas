@vite(['resources/js/catalogo/contratista.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="encabezado-tabla">
    <p class="titulo">Contratista</p>

    <a href="{{url('/contratistas')}}" class="btn-cambio-vista btn">
        <i class="fa-solid fa-eye"></i>
        Ver Lista
    </a>
</div>

<div class="datos-mostrar">
    <form class="marco" action="{{url('/contratistas'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="contenedor-inputs">
            <div class="inputs">
                <label for="nombre_empresa" class="encabezado-input">Empresa</label>
                <input type="text" class="input" name="nombre_empresa" id="nombre_empresa" value="{{$dato->nombre_empresa}}">
            </div>
            <div class="inputs">
                <label for="id_tipo_cedula" class="encabezado-input">Tipo de Cédula</label>
                <select class="input" name="id_tipo_cedula" id="id_tipo_cedula">
                    @foreach ($tipo_cedulas as $tipo_cedula)
                        <option value="{{$tipo_cedula->id}}" {{$dato->id_tipo_cedula == $tipo_cedula->id ? 'selected' : ''}}>{{$tipo_cedula->tipo_cedula}}</option>
                    @endforeach
                </select>
            </div>
            <div class="inputs">
                <label for="telefono_empresa" class="encabezado-input">Teléfono Empresa</label>
                <input type="text" class="input" name="telefono_empresa" id="telefono_empresa" value="{{$dato->telefono_empresa}}">
            </div>
            <div class="inputs">
                <label for="cedula_empresa" class="encabezado-input">Cédula Empresa</label>
                <input type="text" class="input" name="cedula_empresa" id="cedula_empresa" value="{{$dato->cedula_empresa}}">
            </div>
            <div class="inputs">
                <label for="direccion_empresa" class="encabezado-input">Dirección Empresa</label>
                <input type="text" class="input" name="direccion_empresa" id="direccion_empresa" value="{{$dato->direccion_empresa}}">
            </div>
            <div class="inputs">
                <label for="barrio" class="encabezado-input">Barrio</label>
                <input type="text" class="input" name="barrio" id="barrio" value="{{$dato->barrio}}">
            </div>
            <div class="inputs">
                <label for="id_canton" class="encabezado-input">Cantón</label>
                <select class="input" name="id_canton" id="id_canton">
                    @foreach ($cantones as $canton)
                        <option value="{{$canton->id}}" {{$dato->id_canton == $canton->id ? 'selected' : ''}}>{{$canton->canton}}</option>
                    @endforeach
                </select>
            </div>
            <div class="inputs">
                <label for="web" class="encabezado-input">Sitio Web</label>
                <input type="url" class="input" name="web" id="web" value="{{$dato->web}}">
            </div>
            <div class="inputs">
                <label for="nombre_contratista" class="encabezado-input">Nombre del Contratista</label>
                <input type="text" class="input" name="nombre_contratista" id="nombre_contratista" value="{{$dato->nombre_contratista}}">
            </div>
            <div class="inputs">
                <label for="cedula_contratista" class="encabezado-input">Cédula del Contratista</label>
                <input type="text" class="input" name="cedula_contratista" id="cedula_contratista" value="{{$dato->cedula_contratista}}">
            </div>
            <div class="inputs">
                <label for="telefono_contratista" class="encabezado-input">Teléfono del Contratista</label>
                <input type="text" class="input" name="telefono_contratista" id="telefono_contratista" value="{{$dato->telefono_contratista}}">
            </div>
            <div class="inputs">
                <label for="correo_contratista" class="encabezado-input">Correo del Contratista</label>
                <input type="email" class="input" name="correo_contratista" id="correo_contratista" value="{{$dato->correo_contratista}}">
            </div>
            <div class="inputs">
                <label for="documento_ins" class="encabezado-input">Documento INS</label>
                <input type="file" class="input" name="documento_ins" id="documento_ins" value="{{$dato->documento_ins}}">
            </div>
            <div class="inputs">
                <label for="documento_ccss" class="encabezado-input">Documento CCSS</label>
                <input type="file" class="input" name="documento_ccss" id="documento_ccss" value="{{$dato->documento_ccss}}">
            </div>
            <div class="inputs">
                <label for="fecha_ini" class="encabezado-input">Fecha de Inicio</label>
                <input type="date" class="input" name="fecha_ini" id="fecha_ini" value="{{$dato->fecha_ini}}">
            </div>
            <div class="inputs">
                <label for="fecha_fin" class="encabezado-input">Fecha de Fin</label>
                <input type="date" class="input" name="fecha_fin" id="fecha_fin" value="{{$dato->fecha_fin}}">
            </div>
        </div>

        <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
</div>
@endsection
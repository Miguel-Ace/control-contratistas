@vite(['resources/js/catalogo/tipo_documento.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="encabezado-tabla">
    <p class="titulo">Tipos de documentos</p>

    <a href="{{url('/tipos_documentos')}}" class="btn-cambio-vista btn">
        <i class="fa-solid fa-eye"></i>
        Ver Lista
    </a>
</div>

<div class="datos-mostrar">
    <form class="marco" action="{{url('/tipos_documentos'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="contenedor-inputs">
            <div class="inputs">
                <label for="tipo_documento" class="encabezado-input">Tipo de documento</label>
                <input type="text" class="input" name="tipo_documento" id="tipo_documento" value="{{$dato->tipo_documento}}">
            </div>
        </div>

        <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
</div>
@endsection
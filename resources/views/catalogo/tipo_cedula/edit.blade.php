@vite(['resources/js/catalogo/tipo_cedula.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="encabezado-tabla">
    <p class="titulo">Tipos de cédulas</p>

    <a href="{{url('/tipos_cedulas')}}" class="btn-cambio-vista btn">
        <i class="fa-solid fa-eye"></i>
        Ver Lista
    </a>
</div>

<div class="datos-mostrar">
    <form class="marco" action="{{url('/tipos_cedulas'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="contenedor-inputs">
            <div class="inputs">
                <label for="tipo_cedula" class="encabezado-input">Tipo de cédula</label>
                <input type="text" class="input" name="tipo_cedula" id="tipo_cedula" value="{{$dato->tipo_cedula}}">
            </div>
        </div>

        <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
</div>
@endsection
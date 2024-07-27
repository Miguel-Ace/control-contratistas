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
        <form class="marco" action="{{url('/tipos_cedulas')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="tipo_cedula" class="encabezado-input">Tipo de cédula</label>
                    <input type="text" class="input @error('tipo_cedula') error @enderror" name="tipo_cedula" id="tipo_cedula" value="{{old('tipo_cedula')}}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection
@vite(['resources/js/catalogo/tipo_equipo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de equipo</p>

        <a href="{{url('/tipos_equipos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/tipos_equipos')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="tipo_equipo" class="encabezado-input">Tipo de equipo</label>
                    <input type="text" class="input @error('tipo_equipo') error @enderror" name="tipo_equipo" id="tipo_equipo" value="{{old('tipo_equipo')}}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection
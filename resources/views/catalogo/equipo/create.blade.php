@vite(['resources/js/catalogo/equipo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Equipo</p>

        <a href="{{url('/contratistas/equipo/'.$contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/contratistas/equipo/'.$contratista)}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_tipo_equipo" class="encabezado-input">Tipo de Equipo</label>
                    <select class="input @error('id_tipo_equipo') error @enderror" name="id_tipo_equipo" id="id_tipo_equipo">
                        @foreach ($tipos_equipos as $tipo_equipo)
                            <option value="{{$tipo_equipo->id}}" {{ old('id_tipo_equipo') == $tipo_equipo->id ? 'selected' : '' }}>{{$tipo_equipo->tipo_equipo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="equipo" class="encabezado-input">Equipo</label>
                    <input type="text" class="input @error('equipo') error @enderror" name="equipo" id="equipo" value="{{old('equipo')}}">
                </div>
                <div class="inputs">
                    <label for="numero_serie" class="encabezado-input">Número de Serie</label>
                    <input type="text" class="input @error('numero_serie') error @enderror" name="numero_serie" id="numero_serie" value="{{old('numero_serie')}}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection
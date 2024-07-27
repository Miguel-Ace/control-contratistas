@vite(['resources/js/catalogo/equipo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Equipo</p>

        <a href="{{url('/contratistas/equipo/'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/contratistas/equipo/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_tipo_equipo" class="encabezado-input">Tipo de Equipo</label>
                    <select class="input" name="id_tipo_equipo" id="id_tipo_equipo">
                        @foreach ($tipos_equipos as $tipo_equipo)
                            <option value="{{$tipo_equipo->id}}" {{ $dato->id_tipo_equipo == $tipo_equipo->id ? 'selected' : '' }}>{{$tipo_equipo->tipo_equipo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="equipo" class="encabezado-input">Equipo</label>
                    <input type="text" class="input" name="equipo" id="equipo" value="{{$dato->equipo}}">
                </div>
                <div class="inputs">
                    <label for="numero_serie" class="encabezado-input">Número de Serie</label>
                    <input type="text" class="input" name="numero_serie" id="numero_serie" value="{{$dato->numero_serie}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection
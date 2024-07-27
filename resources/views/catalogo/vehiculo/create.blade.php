@vite(['resources/js/catalogo/vehiculo.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Vehiculo</p>

        <a href="{{url('/contratistas/vehiculo/'.$contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/contratistas/vehiculo/'.$contratista)}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="marca" class="encabezado-input">Marca</label>
                    <input type="text" class="input @error('marca') error @enderror" name="marca" id="marca" value="{{old('marca')}}">
                </div>
                <div class="inputs">
                    <label for="modelo" class="encabezado-input">Modelo</label>
                    <input type="text" class="input @error('modelo') error @enderror" name="modelo" id="modelo" value="{{old('modelo')}}">
                </div>
                <div class="inputs">
                    <label for="color" class="encabezado-input">Color</label>
                    <input type="text" class="input @error('color') error @enderror" name="color" id="color" value="{{old('color')}}">
                </div>
                <div class="inputs">
                    <label for="placa" class="encabezado-input">Placa</label>
                    <input type="text" class="input @error('placa') error @enderror" name="placa" id="placa" value="{{old('placa')}}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection
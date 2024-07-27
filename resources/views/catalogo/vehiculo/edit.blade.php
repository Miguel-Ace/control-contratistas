@vite(['resources/js/catalogo/vehiculo.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="encabezado-tabla">
    <p class="titulo">Contratista : {{$nombre_contratista}} / Vehiculo</p>

    <a href="{{url('/contratistas/vehiculo/'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
        <i class="fa-solid fa-eye"></i>
        Ver Lista
    </a>
</div>

<div class="datos-mostrar">
    <form class="marco" action="{{url('/contratistas/vehiculo/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="contenedor-inputs">
            <div class="inputs">
                <label for="marca" class="encabezado-input">Marca</label>
                <input type="text" class="input" name="marca" id="marca" value="{{$dato->marca}}">
            </div>
            <div class="inputs">
                <label for="modelo" class="encabezado-input">Modelo</label>
                <input type="text" class="input" name="modelo" id="modelo" value="{{$dato->modelo}}">
            </div>
            <div class="inputs">
                <label for="color" class="encabezado-input">Color</label>
                <input type="text" class="input" name="color" id="color" value="{{$dato->color}}">
            </div>
            <div class="inputs">
                <label for="placa" class="encabezado-input">Placa</label>
                <input type="text" class="input" name="placa" id="placa" value="{{$dato->placa}}">
            </div>
        </div>

        <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
</div>
@endsection
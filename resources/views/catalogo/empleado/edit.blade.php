@vite(['resources/js/catalogo/contratista.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="encabezado-tabla">
    <p class="titulo">Contratista : {{$nombre_contratista}} / Empleado</p>

    <a href="{{url('/contratistas/empleados/'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
        <i class="fa-solid fa-eye"></i>
        Ver Lista
    </a>
</div>

<div class="datos-mostrar">
    <form class="marco" action="{{url('/contratistas/empleados/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="contenedor-inputs">
            <div class="inputs">
                <label for="nombres" class="encabezado-input">Nombres</label>
                <input type="text" class="input" name="nombres" id="nombres" value="{{$dato->nombres}}">
            </div>
            <div class="inputs">
                <label for="apellidos" class="encabezado-input">Apellidos</label>
                <input type="text" class="input" name="apellidos" id="apellidos" value="{{$dato->apellidos}}">
            </div>
            <div class="inputs">
                <label for="cedula" class="encabezado-input">Cédula</label>
                <input type="text" class="input" name="cedula" id="cedula" value="{{$dato->cedula}}">
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
                <label for="telefono" class="encabezado-input">Teléfono</label>
                <input type="number" class="input" name="telefono" id="telefono" value="{{$dato->telefono}}">
            </div>
            <div class="inputs">
                <label for="email" class="encabezado-input">Email</label>
                <input type="email" class="input" name="email" id="email" value="{{$dato->email}}">
            </div>
            <div class="inputs">
                <label for="direccion" class="encabezado-input">Dirección</label>
                <input type="text" class="input" name="direccion" id="direccion" value="{{$dato->direccion}}">
            </div>
            <div class="inputs">
                <label for="num_seguro" class="encabezado-input">Numero del seguro</label>
                <input type="number" class="input" name="num_seguro" id="num_seguro" value="{{$dato->num_seguro}}">
            </div>
        </div>

        <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
</div>
@endsection
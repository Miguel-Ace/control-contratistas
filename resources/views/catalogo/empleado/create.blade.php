@vite(['resources/js/catalogo/empleado.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Empleado</p>

        <a href="{{url('/contratistas/empleados/'.$contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/contratistas/empleados/'.$contratista)}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="nombres" class="encabezado-input">Nombres</label>
                    <input type="text" class="input @error('nombres') error @enderror" name="nombres" id="nombres" value="{{old('nombres')}}">
                </div>
                <div class="inputs">
                    <label for="apellidos" class="encabezado-input">Apellidos</label>
                    <input type="text" class="input @error('apellidos') error @enderror" name="apellidos" id="apellidos" value="{{old('apellidos')}}">
                </div>
                <div class="inputs">
                    <label for="cedula" class="encabezado-input">Cédula</label>
                    <input type="text" class="input @error('cedula') error @enderror" name="cedula" id="cedula" value="{{old('cedula')}}">
                </div>
                <div class="inputs">
                    <label for="id_tipo_cedula" class="encabezado-input">Tipo de Cédula</label>
                    <select class="input @error('id_tipo_cedula') error @enderror" name="id_tipo_cedula" id="id_tipo_cedula" value="{{old('id_tipo_cedula')}}">
                        @foreach ($tipo_cedulas as $tipo_cedula)
                            <option value="{{$tipo_cedula->id}}">{{$tipo_cedula->tipo_cedula}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="telefono" class="encabezado-input">Teléfono</label>
                    <input type="number" class="input @error('telefono') error @enderror" name="telefono" id="telefono" value="{{old('telefono')}}">
                </div>
                <div class="inputs">
                    <label for="email" class="encabezado-input">Email</label>
                    <input type="email" class="input @error('email') error @enderror" name="email" id="email" value="{{old('email')}}">
                </div>
                <div class="inputs">
                    <label for="direccion" class="encabezado-input">Dirección</label>
                    <input type="text" class="input @error('direccion') error @enderror" name="direccion" id="direccion" value="{{old('direccion')}}">
                </div>
                <div class="inputs">
                    <label for="num_seguro" class="encabezado-input">Numero del seguro</label>
                    <input type="number" class="input @error('num_seguro') error @enderror" name="num_seguro" id="num_seguro" value="{{old('num_seguro')}}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection
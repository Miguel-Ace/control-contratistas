@vite(['resources/js/catalogo/user.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="encabezado-tabla">
    <p class="titulo">
        @role('admin')
            Usuarios
        @elserole('contratista')
            Usuario
        @endrole
    </p>

    <a href="{{url('/user')}}" class="btn-cambio-vista btn">
        <i class="fa-solid fa-eye"></i>
        Ver Lista
    </a>
</div>

<div class="datos-mostrar">
    <form class="marco" action="{{url('/user'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="contenedor-inputs">
            <div class="inputs">
                <label for="name" class="encabezado-input">Nombre</label>
                <input type="text" class="input" name="name" id="name" value="{{$dato->name}}">
            </div>
            <div class="inputs">
                <label for="email" class="encabezado-input">Email</label>
                <input type="email" class="input" name="email" id="email" value="{{$dato->email}}">
            </div>
            <div class="inputs">
                <label for="password" class="encabezado-input">Password</label>
                <div class="input-img">
                    <input type="password" class="input @error('password') error @enderror" name="password" id="password" value="{{old('password')}}" autocomplete>
                    <i class="fa-regular fa-eye-slash icon-cambiar"></i>
                </div>
            </div>
        </div>

        <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
</div>
@endsection
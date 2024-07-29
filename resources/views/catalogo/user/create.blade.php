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
        <form class="marco" action="{{url('/user')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="name" class="encabezado-input">Nombre</label>
                    <input type="text" class="input @error('name') error @enderror" name="name" id="name" value="{{old('name')}}">
                </div>
                <div class="inputs">
                    <label for="email" class="encabezado-input">Email</label>
                    <input type="email" class="input @error('email') error @enderror" name="email" id="email" value="{{old('email')}}">
                </div>
                <div class="inputs">
                    <label for="password" class="encabezado-input">Password</label>
                    <div class="input-img">
                        <input type="password" class="input @error('password') error @enderror" name="password" id="password" value="" autocomplete>
                        <i class="fa-regular fa-eye-slash icon-cambiar"></i>
                    </div>
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection
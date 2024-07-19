@extends('layout.plantilla_auth')

@section('formulario')
    <form action="{{ route('login') }}" method="post" class="formulario-login" novalidate>
        @csrf
        <h2>Iniciar Sesión</h2>
        {{-- <div class="input">
            <div class="encabezado-input">
                <label for="name">Nombre</label>
                @error('name')
                <p class="texto-error">{{$message}}</p>
                @enderror
            </div>
            <input type="text" id="name" name="name" class="@error('name') error @enderror" value="{{old('name')}}" placeholder="Escribe tu nombre">
        </div> --}}

        <div class="input">
            <div class="encabezado-input">
                <label for="email">Email</label>
                @error('email')
                    <p class="texto-error">{{$message}}</p>
                @enderror
            </div>
            <input type="email" id="email" name="email" placeholder="Escribe tu email">
        </div>

        <div class="input">
            <div class="encabezado-input">
                <label for="password">Password</label>
                @error('password')
                    <p class="texto-error">{{$message}}</p>
                @enderror
            </div>
            <input type="password" id="password" name="password" placeholder="Escribe tu password">
        </div>

        <button class="btn-login btn"><i class="fa-solid fa-paper-plane"></i> Acceder</button>
    </form>
@endsection
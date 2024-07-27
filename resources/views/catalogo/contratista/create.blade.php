@vite(['resources/js/catalogo/contratista.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista</p>

        <a href="{{url('/contratistas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/contratistas')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="nombre_empresa" class="encabezado-input">Empresa</label>
                    <input type="text" class="input @error('nombre_empresa') error @enderror" name="nombre_empresa" id="nombre_empresa" value="{{old('nombre_empresa')}}">
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
                    <label for="telefono_empresa" class="encabezado-input">Teléfono Empresa</label>
                    <input type="number" class="input @error('telefono_empresa') error @enderror" name="telefono_empresa" id="telefono_empresa" value="{{old('telefono_empresa')}}">
                </div>
                <div class="inputs">
                    <label for="cedula_empresa" class="encabezado-input">Cédula Empresa</label>
                    <input type="text" class="input @error('cedula_empresa') error @enderror" name="cedula_empresa" id="cedula_empresa" value="{{old('cedula_empresa')}}">
                </div>
                <div class="inputs">
                    <label for="direccion_empresa" class="encabezado-input">Dirección Empresa</label>
                    <input type="text" class="input @error('direccion_empresa') error @enderror" name="direccion_empresa" id="direccion_empresa" value="{{old('direccion_empresa')}}">
                </div>
                <div class="inputs">
                    <label for="barrio" class="encabezado-input">Barrio</label>
                    <input type="text" class="input @error('barrio') error @enderror" name="barrio" id="barrio" value="{{old('barrio')}}">
                </div>
                <div class="inputs">
                    <label for="id_canton" class="encabezado-input">Cantón</label>
                    <select class="input @error('id_canton') error @enderror" name="id_canton" id="id_canton" value="{{old('id_canton')}}">
                        @foreach ($cantones as $canton)
                            <option value="{{$canton->id}}">{{$canton->canton}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="web" class="encabezado-input">Sitio Web</label>
                    <input type="url" class="input @error('web') error @enderror" name="web" id="web" value="{{old('web')}}">
                </div>
                <div class="inputs">
                    <label for="nombre_contratista" class="encabezado-input">Nombre del Contratista</label>
                    <input type="text" class="input @error('nombre_contratista') error @enderror" name="nombre_contratista" id="nombre_contratista" value="{{old('nombre_contratista')}}">
                </div>
                <div class="inputs">
                    <label for="cedula_contratista" class="encabezado-input">Cédula del Contratista</label>
                    <input type="text" class="input @error('cedula_contratista') error @enderror" name="cedula_contratista" id="cedula_contratista" value="{{old('cedula_contratista')}}">
                </div>
                <div class="inputs">
                    <label for="telefono_contratista" class="encabezado-input">Teléfono del Contratista</label>
                    <input type="number" class="input @error('telefono_contratista') error @enderror" name="telefono_contratista" id="telefono_contratista" value="{{old('telefono_contratista')}}">
                </div>
                <div class="inputs">
                    <label for="correo_contratista" class="encabezado-input">Correo del Contratista</label>
                    <input type="email" class="input @error('correo_contratista') error @enderror" name="correo_contratista" id="correo_contratista" value="{{old('correo_contratista')}}">
                </div>
                <div class="inputs">
                    <label for="documento_ins" class="encabezado-input">Documento INS</label>
                    <input type="file" class="input @error('documento_ins') error @enderror" name="documento_ins" id="documento_ins" value="{{old('documento_ins')}}">
                </div>
                <div class="inputs">
                    <label for="documento_ccss" class="encabezado-input">Documento CCSS</label>
                    <input type="file" class="input @error('documento_ccss') error @enderror" name="documento_ccss" id="documento_ccss" value="{{old('documento_ccss')}}">
                </div>
                <div class="inputs">
                    <label for="fecha_ini" class="encabezado-input">Fecha de Inicio</label>
                    <input type="date" class="input @error('fecha_ini') error @enderror" name="fecha_ini" id="fecha_ini" value="{{old('fecha_ini')}}">
                </div>
                <div class="inputs">
                    <label for="fecha_fin" class="encabezado-input">Fecha de Fin</label>
                    <input type="date" class="input @error('fecha_fin') error @enderror" name="fecha_fin" id="fecha_fin" value="{{old('fecha_fin')}}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection
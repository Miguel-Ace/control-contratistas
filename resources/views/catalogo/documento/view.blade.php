@vite(['resources/js/catalogo/documento.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Contratista : {{$nombre_contratista}} / Documento</p>
        
        <a href="{{url('/contratistas/documento/'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Empleado:</p>
                    <p class="valor">{{$dato->empleados->nombres}} {{$dato->empleados->apellidos}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Vehículo:</p>
                    <p class="valor">{{$dato->vehiculos->marca}} {{$dato->vehiculos->modelo}} {{$dato->vehiculos->color}} Placa: {{$dato->vehiculos->placa}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Vencimiento:</p>
                    <p class="valor">{{$dato->fecha_vencimiento}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Observación:</p>
                    <p class="valor">{{$dato->observacion}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Attach:</p>
                    <p class="valor">
                        <a href="{{asset('storage').'/documentos'.'/'.$dato->attach}}" class="document">
                            <ion-icon name="document-text-outline"></ion-icon>
                            {{$dato->attach}}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
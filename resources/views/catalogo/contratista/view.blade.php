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
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">

                <div class="detalle">
                    <p class="clave">Empresa:</p>
                    <p class="valor">{{$dato->nombre_empresa}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Tipo de Cédula:</p>
                    <p class="valor">{{$dato->tipos_cedulas->tipo_cedula}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Teléfono Empresa:</p>
                    <p class="valor">{{$dato->telefono_empresa}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Cédula Empresa:</p>
                    <p class="valor">{{$dato->cedula_empresa}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Dirección Empresa:</p>
                    <p class="valor">{{$dato->direccion_empresa}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Barrio:</p>
                    <p class="valor">{{$dato->barrio}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Cantón:</p>
                    <p class="valor">{{$dato->cantones->canton}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Provincia:</p>
                    <p class="valor">{{$dato->provincias->provincia}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Sitio Web:</p>
                    <p class="valor"><a href="{{$dato->web}}" target="blank">{{$dato->web}}</a></p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Nombre del Contratista:</p>
                    <p class="valor">{{$dato->nombre_contratista}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Cédula del Contratista:</p>
                    <p class="valor">{{$dato->cedula_contratista}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Teléfono del Contratista:</p>
                    <p class="valor">{{$dato->telefono_contratista}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Correo del Contratista:</p>
                    <p class="valor">{{$dato->correo_contratista}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Documento INS:</p>
                    <p class="valor">
                        @if (Storage::disk('public')->exists('/documentos_contratistas'.'/'.$dato->id.'/'.$dato->documento_ins))
                            <a href="{{asset('storage').'/documentos_contratistas'.'/'.$dato->id.'/'.$dato->documento_ins}}" class="document">
                                <ion-icon name="document-text-outline"></ion-icon>
                                {{$dato->documento_ins}}
                            </a>
                        @else
                            No existe documento
                        @endif
                    </p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Documento CCSS:</p>
                    <p class="valor">
                        @if (Storage::disk('public')->exists('/documentos_contratistas'.'/'.$dato->id.'/'.$dato->documento_ccss))
                            <a href="{{asset('storage').'/documentos_contratistas'.'/'.$dato->id.'/'.$dato->documento_ccss}}" class="document">
                                <ion-icon name="document-text-outline"></ion-icon>
                                {{$dato->documento_ccss}}
                            </a>
                        @else
                            No existe documento
                        @endif
                    </p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Inicio:</p>
                    <p class="valor">{{$dato->fecha_ini}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Fin:</p>
                    <p class="valor">{{$dato->fecha_fin}}</p>
                </div>

                <div class="detalle">
                    <p class="clave">Activo / Aprobado:</p>
                    <p class="valor">{{$dato->activo ? 'Si' : 'No'}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
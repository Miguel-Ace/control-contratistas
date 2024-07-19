<?php

namespace App\Http\Controllers\catalogo;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogoController extends Controller
{
    // Usuarios
    public function user_index() {
        $user = auth()->user();
        return view('catalogo.user.index', compact('user'));
    }
    
    // Contratista
    public function contratista_index() {
        $user = auth()->user();
        return view('catalogo.contratista.index', compact('user'));
    }
    
    // Tipo equipo
    public function tipos_equipos_index() {
        $user = auth()->user();
        return view('catalogo.tipo_equipo.index', compact('user'));
    }
    
    // Tipo documento
    public function tipos_documentos_index() {
        $user = auth()->user();
        return view('catalogo.tipo_documento.index', compact('user'));
    }
    
    // Tipo cédula
    public function tipos_cedulas_index() {
        $user = auth()->user();
        return view('catalogo.tipo_cedula.index', compact('user'));
    }
    
    // Equipo
    public function equipos_index() {
        $user = auth()->user();
        return view('catalogo.equipo.index', compact('user'));
    }
    
    // Documento
    public function documentos_index() {
        $user = auth()->user();
        return view('catalogo.documento.index', compact('user'));
    }
    
    // Vehiculo
    public function vehiculos_index() {
        $user = auth()->user();
        return view('catalogo.vehiculo.index', compact('user'));
    }
    
    // Empleado
    public function empleados_index() {
        $user = auth()->user();
        return view('catalogo.empleado.index', compact('user'));
    }
}

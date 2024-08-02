<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Canton;
use App\Models\Contratista;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Provincia;
use App\Models\Tipo_cedula;
use App\Models\Tipo_documento;
use App\Models\Tipo_equipo;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isNull;

class ApiController extends Controller
{
    // Usuarios
    public function all_user(){
        return response()->json(User::all(),200);
    }

    public function get_user_id($id){
        return response()->json(User::find($id),200);
    }

    public function getUserNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = User::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_user(Request $request){
        $dato = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        
        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        
        $dato->assignRole('contratista');

        return response()->json($dato,200);
    }

    public function update_user(Request $request, $id){
        $dato = User::find($id);
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update([
            'name' => $request->filled('name') ? $request['name'] : $dato->name,
            'email' => $request->filled('email') ? $request['email'] : $dato->email,
            'password' => $request->filled('password') ? Hash::make($request['password']) : $dato->password
        ]);

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_user($id){
        $dato = User::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }

    // // // //
    public function all_contratistas(){
        return response()->json(Contratista::all()->load('usuarios','tipos_cedulas','cantones','provincias'),200);
    }

    public function get_contratistas_id($id){
        return response()->json(Contratista::find($id)->load('usuarios','tipos_cedulas','cantones','provincias'),200);
    }

    public function all_vehiculos(){
        return response()->json(Vehiculo::all()->load('contratistas'),200);
    }

    public function vehiculos_x_contratista($id){
        $dato = Vehiculo::where('id_contratista',$id)->get()->load('contratistas');
        return response()->json($dato,200);
    }

    public function all_documentos(){
        return response()->json(Documento::all()->load('contratistas','empleados','vehiculos','tipos_documentos'),200);
    }
    
    public function documentos_x_contratista($id){
        $dato = Documento::where('id_contratista',$id)->get()->load('contratistas','empleados','vehiculos','tipos_documentos');
        return response()->json($dato,200);
    }
}

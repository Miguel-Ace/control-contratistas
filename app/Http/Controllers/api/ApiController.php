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

    // Cantón
    public function all_cantones(){
        return response()->json(Canton::all()->load('provincias'),200);
    }

    // Provincia
    public function all_provincia(){
        return response()->json(Provincia::all()->load('provincias'),200);
    }

    // Contratista
    public function all_contratistas(){
        return response()->json(Contratista::all()->load('usuarios','tipos_cedulas','cantones','provincias'),200);
    }

    public function get_contratistas_id($id){
        return response()->json(Contratista::find($id)->load('usuarios','tipos_cedulas','cantones','provincias'),200);
    }

    public function getContratistasNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = Contratista::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_contratistas(Request $request, $user){
        $canton = Canton::find($request['id_canton'])->load('provincias');
        $provincia = $canton->provincias->id;
        
        $dato = Contratista::create([
            'nombre_empresa' => $request['nombre_empresa'],
            'id_tipo_cedula' => $request['id_tipo_cedula'],
            'id_user' => $user,
            'telefono_empresa' => $request['telefono_empresa'],
            'cedula_empresa' => $request['cedula_empresa'],
            'direccion_empresa' => $request['direccion_empresa'],
            'barrio' => $request['barrio'],
            'id_canton' => $request['id_canton'],
            'id_provincia' => $provincia,
            'web' => $request['web'],
            'nombre_contratista' => $request['nombre_contratista'],
            'cedula_contratista' => $request['cedula_contratista'],
            'telefono_contratista' => $request['telefono_contratista'],
            'correo_contratista' => $request['correo_contratista'],
            'documento_ins' => $request['documento_ins'],
            'documento_ccss' => $request['documento_ccss'],
            'fecha_ini' => $request['fecha_ini'],
            'fecha_fin' => $request['fecha_fin'],
            'activo' => 0,
        ]);

        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }

        return response()->json($dato,200);
    }

    public function update_contratistas(Request $request, $id){
        $dato = Contratista::find($id)->load('usuarios','tipos_cedulas','cantones','provincias');
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $canton = Canton::find($request['id_canton'])->load('provincias');
        $provincia = $canton->provincias->id;

        $dato->update([
            'nombre_empresa' => $request->filled('nombre_empresa') ? $request['nombre_empresa'] : $dato->nombre_empresa,
            'id_tipo_cedula' => $request->filled('id_tipo_cedula') ? $request['id_tipo_cedula'] : $dato->id_tipo_cedula,
            'id_user' => $dato->id_user,
            'telefono_empresa' => $request->filled('telefono_empresa') ? $request['telefono_empresa'] : $dato->telefono_empresa,
            'cedula_empresa' => $request->filled('cedula_empresa') ? $request['cedula_empresa'] : $dato->cedula_empresa,
            'direccion_empresa' => $request->filled('direccion_empresa') ? $request['direccion_empresa'] : $dato->direccion_empresa,
            'barrio' => $request->filled('barrio') ? $request['barrio'] : $dato->barrio,
            'id_canton' => $request->filled('id_canton') ? $request['id_canton'] : $dato->id_canton,
            'id_provincia' => $request->filled('id_canton') ?  $provincia : $dato->id_provincia,
            'web' => $request->filled('web') ? $request['web'] : $dato->web,
            'nombre_contratista' => $request->filled('nombre_contratista') ? $request['nombre_contratista'] : $dato->nombre_contratista,
            'cedula_contratista' => $request->filled('cedula_contratista') ? $request['cedula_contratista'] : $dato->cedula_contratista,
            'telefono_contratista' => $request->filled('telefono_contratista') ? $request['telefono_contratista'] : $dato->telefono_contratista,
            'correo_contratista' => $request->filled('correo_contratista') ? $request['correo_contratista'] : $dato->correo_contratista,
            'documento_ins' => $request->filled('documento_ins') ? $request['documento_ins'] : $dato->documento_ins,
            'documento_ccss' => $request->filled('documento_ccss') ? $request['documento_ccss'] : $dato->documento_ccss,
            'fecha_ini' => $request->filled('fecha_ini') ? $request['fecha_ini'] : $dato->fecha_ini,
            'fecha_fin' => $request->filled('fecha_fin') ? $request['fecha_fin'] : $dato->fecha_fin,
            'activo' => $dato->activo,
        ]);

        return response()->json(['Actualizado' => $dato],200);
    }

    public function update_contratistas_activo(Request $request, $id){
        $dato = Contratista::find($id)->load('usuarios','tipos_cedulas','cantones','provincias');
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update([
            'activo' => $dato->activo == 1 ? 0 : 1,
        ]);

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_contratistas($id){
        $dato = Contratista::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }

    // Tipo equipo
    public function all_tipos_equipos(){
        return response()->json(Tipo_equipo::all(),200);
    }

    public function get_tipos_equipos_id($id){
        return response()->json(Tipo_equipo::find($id),200);
    }

    public function getTipos_equiposNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = Tipo_equipo::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_tipos_equipos(Request $request){
        $dato = Tipo_equipo::create($request->all());

        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }

        return response()->json($dato,200);
    }

    public function update_tipos_equipos(Request $request, $id){
        $dato = Tipo_equipo::find($id);
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update($request->all());

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_tipos_equipos($id){
        $dato = Tipo_equipo::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }

    // Tipo documento
    public function all_tipos_documentos(){
        return response()->json(Tipo_documento::all(),200);
    }

    public function get_tipos_documentos_id($id){
        return response()->json(Tipo_documento::find($id),200);
    }

    public function gettipos_documentosNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = Tipo_documento::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_tipos_documentos(Request $request){
        if ($request->file('attach')) {
            // $datos['archivo'] = $request->file('archivo')->store('archivos','public');
            $datos['attach'] = $request->file('attach')->storeAs('archivos', $request->file('attach')->getClientOriginalName(), 'public');
        }
        
        $dato = Tipo_documento::create($request->all());

        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }

        return response()->json($dato,200);
    }

    public function update_tipos_documentos(Request $request, $id){
        $dato = Tipo_documento::find($id);
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update($request->all());

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_tipos_documentos($id){
        $dato = Tipo_documento::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }

    // Tipo cédula
    public function all_tipos_cedulas(){
        return response()->json(Tipo_cedula::all(),200);
    }

    public function get_tipos_cedulas_id($id){
        return response()->json(Tipo_cedula::find($id),200);
    }

    public function getTipos_cedulasNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = Tipo_cedula::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_tipos_cedulas(Request $request){
        $dato = Tipo_cedula::create($request->all());

        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }

        return response()->json($dato,200);
    }

    public function update_tipos_cedulas(Request $request, $id){
        $dato = Tipo_cedula::find($id);
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update($request->all());

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_tipos_cedulas($id){
        $dato = Tipo_cedula::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }

    // Equipo
    public function all_equipos(){
        return response()->json(Equipo::all()->load('contratistas','tipos_equipos'),200);
    }

    public function get_equipos_id($id){
        return response()->json(Equipo::find($id)->load('contratistas','tipos_equipos'),200);
    }

    public function getequiposNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = Equipo::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_equipos(Request $request){
        $dato = Equipo::create($request->all());

        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }

        return response()->json($dato,200);
    }

    public function update_equipos(Request $request, $id){
        $dato = Equipo::find($id)->load('contratistas','tipos_equipos');
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update([
            'id_contratista' => $request->filled('id_contratista') ? $request['id_contratista'] : $dato->id_contratista,
            'id_tipo_equipo' => $request->filled('id_tipo_equipo') ? $request['id_tipo_equipo'] : $dato->id_tipo_equipo,
            'equipo' => $request->filled('equipo') ? $request['equipo'] : $dato->equipo,
            'numero_serie' => $request->filled('numero_serie') ? $request['numero_serie'] : $dato->numero_serie,
        ]);

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_equipos($id){
        $dato = Equipo::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }

    // Documento
    public function all_documentos(){
        return response()->json(Documento::all()->load('contratistas','empleados','vehiculos'),200);
    }

    public function get_documentos_id($id){
        return response()->json(Documento::find($id)->load('contratistas','empleados','vehiculos'),200);
    }

    public function getDocumentosNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = Documento::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_documentos(Request $request){
        $dato = Documento::create($request->all());

        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }

        return response()->json($dato,200);
    }

    public function update_documentos(Request $request, $id){
        $dato = Documento::find($id)->load('contratistas','empleados','vehiculos');
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update([
            'id_contratista' => $request->filled('id_contratista') ? $request['id_contratista'] : $dato->id_contratista,
            'id_empleado' => $request->filled('id_empleado') ? $request['id_empleado'] : $dato->id_empleado,
            'id_vehiculo' => $request->filled('id_vehiculo') ? $request['id_vehiculo'] : $dato->id_vehiculo,
            'fecha_vencimiento' => $request->filled('fecha_vencimiento') ? $request['fecha_vencimiento'] : $dato->fecha_vencimiento,
            'observacion' => $request->filled('observacion') ? $request['observacion'] : $dato->observacion,
            'attach' => $request->filled('attach') ? $request['attach'] : $dato->attach,
        ]);

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_documentos($id){
        $dato = Documento::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }

    // Vehiculo
    public function all_vehiculos(){
        return response()->json(Vehiculo::all()->load('contratistas'),200);
    }

    public function get_vehiculos_id($id){
        return response()->json(Vehiculo::find($id)->load('contratistas'),200);
    }

    public function getVehiculosNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = Vehiculo::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_vehiculos(Request $request){
        $dato = Vehiculo::create($request->all());

        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }

        return response()->json($dato,200);
    }

    public function update_vehiculos(Request $request, $id){
        $dato = Vehiculo::find($id)->load('contratistas');
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update([
            'id_contratista' => $request->filled('id_contratista') ? $request['id_contratista'] : $dato->id_contratista,
            'marca' => $request->filled('marca') ? $request['marca'] : $dato->marca,
            'modelo' => $request->filled('modelo') ? $request['modelo'] : $dato->modelo,
            'color' => $request->filled('color') ? $request['color'] : $dato->color,
            'placa' => $request->filled('placa') ? $request['placa'] : $dato->placa,
        ]);

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_vehiculos($id){
        $dato = Vehiculo::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }

    // Empleado
    public function all_empleados(){
        return response()->json(Empleado::all()->load('contratistas','tipos_cedulas'),200);
    }

    public function get_empleados_id($id){
        return response()->json(Empleado::find($id)->load('contratistas','tipos_cedulas'),200);
    }

    public function getEmpleadosNameById($id, $campo){
        // Usar find y select para obtener solo el campo 'name'
        $dato = Empleado::select($campo)->find($id);

        // Verificar si se encontró el usuario
        if ($dato) {
            return response()->json(['campo' => $dato], 200);
        } else {
            return response()->json(['message' => 'No se encontró el campo o regístro'], 404);
        }
    }

    public function insert_empleados(Request $request){
        $dato = Empleado::create($request->all());

        if (is_null($dato)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }

        return response()->json($dato,200);
    }

    public function update_empleados(Request $request, $id){
        $dato = Empleado::find($id)->load('contratistas','tipos_cedulas');
        if (is_null($dato)) {
            return response()->json('No existe', 404);
        }

        $dato->update([
            'nombres' => $request->filled('nombres') ? $request['nombres'] : $dato->nombres,
            'apellidos' => $request->filled('apellidos') ? $request['apellidos'] : $dato->apellidos,
            'cedula' => $request->filled('cedula') ? $request['cedula'] : $dato->cedula,
            'id_tipo_cedula' => $request->filled('id_tipo_cedula') ? $request['id_tipo_cedula'] : $dato->id_tipo_cedula,
            'telefono' => $request->filled('telefono') ? $request['telefono'] : $dato->telefono,
            'email' => $request->filled('email') ? $request['email'] : $dato->email,
            'direccion' => $request->filled('direccion') ? $request['direccion'] : $dato->direccion,
            'num_seguro' => $request->filled('num_seguro') ? $request['num_seguro'] : $dato->num_seguro,
        ]);

        return response()->json(['Actualizado' => $dato],200);
    }

    public function delete_empleados($id){
        $dato = Empleado::destroy($id);
        return response()->json(['Eliminado' => $dato],200);
    }
}

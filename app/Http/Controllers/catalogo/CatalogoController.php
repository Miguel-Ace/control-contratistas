<?php

namespace App\Http\Controllers\catalogo;

use App\Models\User;
use App\Models\Canton;
use App\Models\Contratista;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Tipo_cedula;
use App\Models\Tipo_documento;
use App\Models\Tipo_equipo;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class CatalogoController extends Controller
{    
    /////// Rol
    public function user_rol_create(Request $request, $user) {
        $usuario = User::find($user);
        // Borrar todos los roles del usuario
        $usuario->syncRoles([]);
        // Asignarle el rol al usuario
        $usuario->assignRole($request['rol']);

        return redirect()->back()->with(['mensaje' => 'Rol Actualizado']);
    }

    /////// Usuarios
    public function user_index() {
        $roles = Role::all();
        
        $datos = [];
        $user = User::find(auth()->user()->id);
        $user_rol = $user->getRoleNames();
        if ($user_rol[0] == 'admin') {
            $datos = User::where('id', '!=', 1)->get();
        }else{
            $datos = [$user];
        }
        return view('catalogo.user.index', compact('datos','roles'));
    }

    public function user_create() {
        return view('catalogo.user.create');
    }

    public function user_view($id) {
        $dato = User::find($id);
        return view('catalogo.user.view', compact('dato'));
    }

    public function user_edit($id) {
        $dato = User::find($id);
        return view('catalogo.user.edit', compact('dato'));
    }

    public function user_store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ],[
            'password.min' => 'Minimo 8 carácteres'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        $user->assignRole('contratista');

        return redirect('/user')->with(['mensaje' => 'Información Creada']);
    }

    public function user_update(Request $request, $id) {
        $usuario = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'min:8',
        ],[
            'password.min' => 'Minimo 8 carácteres'
        ]);

        $usuario->update([
            'name' => $request['name'] ? $request['name'] : $usuario['name'],
            'email' => $request['email'] ? $request['email'] : $usuario['email'],
            'password' => $request['password'] ? Hash::make($request['password']) : $usuario['password']
        ]);

        return redirect('/user')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Contratista
    public function contratista_index() {
        $datos = [];
        $user = User::find(auth()->user()->id);
        $user_rol = $user->getRoleNames();
        $pasar = true;

        if ($user_rol->isNotEmpty() && $user_rol[0] == 'contratista') {
            $contratista = Contratista::where('id_user', $user->id)->get();
            if ($contratista->isEmpty()) {
                $pasar = true;
            } else {
                $pasar = false;
                $datos = $contratista;
            }
        } else {
            $pasar = false;
            $datos = Contratista::all();
        }

        return view('catalogo.contratista.index', compact('datos','pasar'));
    }

    public function contratista_create() {
        $tipo_cedulas = Tipo_cedula::all();
        $cantones = Canton::all();
        return view('catalogo.contratista.create', compact('tipo_cedulas','cantones'));
    }

    public function contratista_view($id) {
        $dato = Contratista::find($id);
        return view('catalogo.contratista.view', compact('dato'));
    }

    public function contratista_edit($id) {
        $tipo_cedulas = Tipo_cedula::all();
        $cantones = Canton::all();
        $dato = Contratista::find($id);
        return view('catalogo.contratista.edit', compact('tipo_cedulas','cantones','dato'));
    }

    public function contratista_store(Request $request) {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'id_tipo_cedula' => 'required|integer|exists:tipo_cedulas,id',
            'telefono_empresa' => 'required|string|max:15',
            'cedula_empresa' => 'required|string|max:20',
            'direccion_empresa' => 'required|string|max:255',
            'barrio' => 'required|string|max:255',
            'id_canton' => 'required|integer|exists:cantones,id',
            'web' => 'required|url|max:255',
            'nombre_contratista' => 'required|string|max:255',
            'cedula_contratista' => 'required|string|max:20',
            'telefono_contratista' => 'required|string|max:15',
            'correo_contratista' => 'required|email|max:255',
            'documento_ins' => 'required|file',
            'documento_ccss' => 'required|file|max:255',
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_ini',
        ]);

        if ($request->file('documento_ins') && $request->file('documento_ccss')) {
            $datos['documento_ins'] = $request->file('documento_ins')->storeAs('documentos_contratistas', $request->file('documento_ins')->getClientOriginalName(), 'public');
            $datos['documento_ccss'] = $request->file('documento_ccss')->storeAs('documentos_contratistas', $request->file('documento_ccss')->getClientOriginalName(), 'public');
        }
        
        $canton = Canton::find($request['id_canton'])->load('provincias');
        $provincia = $canton->provincias->id;

        Contratista::create([
            'nombre_empresa' => $request['nombre_empresa'],
            'id_tipo_cedula' => $request['id_tipo_cedula'],
            'id_user' => auth()->user()->id,
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
            'documento_ins' => $request->file('documento_ins')->getClientOriginalName(),
            'documento_ccss' => $request->file('documento_ccss')->getClientOriginalName(),
            'fecha_ini' => $request['fecha_ini'],
            'fecha_fin' => $request['fecha_fin'],
            'activo' => 0,
        ]);

        return redirect('/contratistas')->with(['mensaje' => 'Información Creada']);
    }

    public function contratista_update(Request $request, $id) {
        $contratista = Contratista::find($id);
        $canton = Canton::find($request['id_canton'])->load('provincias');
        $provincia = $canton->provincias->id;

        // Declarando ruta del archivo ins a eliminar
        $doc_ins = 'public/documentos_contratistas/'.$contratista->documento_ins;
        // Verificar si el existe archivo anterior y comprobar si el usuario pasó documento nuevo
        if (Storage::exists($doc_ins) && $request->file('documento_ins')) {
            // Eliminar el archivo
            Storage::delete($doc_ins);
            // Creando el nuevo archivo
            $request->file('documento_ins')->storeAs('documentos_contratistas', $request->file('documento_ins')->getClientOriginalName(), 'public');
        }

        // Declarando ruta del archivo ccss a eliminar
        $doc_ccss = 'public/documentos_contratistas/'.$contratista->documento_ccss;
        // Verificar si el existe archivo anterior y comprobar si el usuario pasó documento nuevo
        if (Storage::exists($doc_ccss) && $request->file('documento_ccss')) {
            // Eliminar el archivo
            Storage::delete($doc_ccss);
            // Creando el nuevo archivo
            $request->file('documento_ccss')->storeAs('documentos_contratistas', $request->file('documento_ccss')->getClientOriginalName(), 'public');
        }

        $contratista->update([
            'nombre_empresa' => $request['nombre_empresa'] ? $request['nombre_empresa'] : $contratista['nombre_empresa'],
            'id_tipo_cedula' => $request['id_tipo_cedula'] ? $request['id_tipo_cedula'] : $contratista['id_tipo_cedula'],
            'id_user' => $contratista['id_user'],
            'telefono_empresa' => $request['telefono_empresa'] ? $request['telefono_empresa'] : $contratista['telefono_empresa'],
            'cedula_empresa' => $request['cedula_empresa'] ? $request['cedula_empresa'] : $contratista['cedula_empresa'],
            'direccion_empresa' => $request['direccion_empresa'] ? $request['direccion_empresa'] : $contratista['direccion_empresa'],
            'barrio' => $request['barrio'] ? $request['barrio'] : $contratista['barrio'],
            'id_canton' => $request['id_canton'] ? $request['id_canton'] : $contratista['id_canton'],
            'id_provincia' => $request['id_canton'] ? $provincia : $contratista['id_provincia'],
            'web' => $request['web'] ? $request['web'] : $contratista['web'],
            'nombre_contratista' => $request['nombre_contratista'] ? $request['nombre_contratista'] : $contratista['nombre_contratista'],
            'cedula_contratista' => $request['cedula_contratista'] ? $request['cedula_contratista'] : $contratista['cedula_contratista'],
            'telefono_contratista' => $request['telefono_contratista'] ? $request['telefono_contratista'] : $contratista['telefono_contratista'],
            'correo_contratista' => $request['correo_contratista'] ? $request['correo_contratista'] : $contratista['correo_contratista'],
            'documento_ins' => $request['documento_ins'] ? $request->file('documento_ins')->getClientOriginalName() : $contratista['documento_ins'],
            'documento_ccss' => $request['documento_ccss'] ? $request->file('documento_ccss')->getClientOriginalName() : $contratista['documento_ccss'],
            'fecha_ini' => $request['fecha_ini'] ? $request['fecha_ini'] : $contratista['fecha_ini'],
            'fecha_fin' => $request['fecha_fin'] ? $request['fecha_fin'] : $contratista['fecha_fin'],
        ]);

        return redirect('/contratistas')->with(['mensaje' => 'Información Actualizada']);
    }
    
    public function contratista_activo_update(Request $request, $id) {
        $contratista = Contratista::find($id);

        $contratista->update(['activo' => $request['activo'] ? 0 : 1]);
        
        return redirect()->back()->with(['mensaje' => 'Usuario Actualizada']);
    }
    
    /////// Empleado
    public function empleados_index($contratista) {
        $nombre_contratista = Contratista::find($contratista)->pluck('nombre_contratista')[0];
        $datos = Empleado::where('id_contratista',$contratista)->get();
        return view('catalogo.empleado.index', compact('datos','contratista','nombre_contratista'));
    }
    
    public function empleado_create($contratista) {
        $nombre_contratista = Contratista::find($contratista)->pluck('nombre_contratista')[0];
        $tipo_cedulas = Tipo_cedula::all();
        return view('catalogo.empleado.create', compact('tipo_cedulas','contratista','nombre_contratista'));
    }

    public function empleado_view($id) {
        $dato = Empleado::find($id);
        $nombre_contratista = Contratista::find($dato->id_contratista)->pluck('nombre_contratista')[0];
        return view('catalogo.empleado.view', compact('dato','nombre_contratista'));
    }

    public function empleado_edit($id) {
        $dato = Empleado::find($id);
        $nombre_contratista = Contratista::find($dato->id_contratista)->pluck('nombre_contratista')[0];
        $tipo_cedulas = Tipo_cedula::all();
        return view('catalogo.empleado.edit', compact('tipo_cedulas','dato','nombre_contratista'));
    }

    public function empleado_store(Request $request, $contratista) {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'id_tipo_cedula' => 'required|integer|exists:tipo_cedulas,id',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'direccion' => 'required|string|max:255',
            'num_seguro' => 'required|string|max:20',
        ]);

        Empleado::create([
            'id_contratista' => $contratista,
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'cedula' => $request['cedula'],
            'id_tipo_cedula' => $request['id_tipo_cedula'],
            'telefono' => $request['telefono'],
            'email' => $request['email'],
            'direccion' => $request['direccion'],
            'num_seguro' => $request['num_seguro'],
        ]);

        return redirect('/contratistas/empleados/'.$contratista)->with(['mensaje' => 'Información Creada']);
    }

    public function empleado_update(Request $request, $id) {

        $empleado = Empleado::find($id);

        $empleado->update([
            'id_contratista' => $empleado['id_contratista'],
            'nombres' => $request['nombres'] ? $request['nombres'] : $empleado['nombres'],
            'apellidos' => $request['apellidos'] ? $request['apellidos'] : $empleado['apellidos'],
            'cedula' => $request['cedula'] ? $request['cedula'] : $empleado['cedula'],
            'id_tipo_cedula' => $request['id_tipo_cedula'] ? $request['id_tipo_cedula'] : $empleado['id_tipo_cedula'],
            'telefono' => $request['telefono'] ? $request['telefono'] : $empleado['telefono'],
            'email' => $request['email'] ? $request['email'] : $empleado['email'],
            'direccion' => $request['direccion'] ? $request['direccion'] : $empleado['direccion'],
            'num_seguro' => $request['num_seguro'] ? $request['num_seguro'] : $empleado['num_seguro'],
        ]);

        return redirect('/contratistas/empleados/'.$empleado['id_contratista'])->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Vehiculo
    public function vehiculo_index($contratista) {
        $nombre_contratista = Contratista::find($contratista)->pluck('nombre_contratista')[0];
        $datos = Vehiculo::where('id_contratista',$contratista)->get();
        return view('catalogo.vehiculo.index', compact('datos','contratista','nombre_contratista'));
    }
    
    public function vehiculo_create($contratista) {
        $nombre_contratista = Contratista::find($contratista)->pluck('nombre_contratista')[0];
        return view('catalogo.vehiculo.create', compact('contratista','nombre_contratista'));
    }

    public function vehiculo_view($id) {
        $dato = Vehiculo::find($id);
        $nombre_contratista = Contratista::find($dato->id_contratista)->pluck('nombre_contratista')[0];
        return view('catalogo.vehiculo.view', compact('dato','nombre_contratista'));
    }

    public function vehiculo_edit($id) {
        $dato = Vehiculo::find($id);
        $nombre_contratista = Contratista::find($dato->id_contratista)->pluck('nombre_contratista')[0];
        return view('catalogo.vehiculo.edit', compact('dato','nombre_contratista'));
    }

    public function vehiculo_store(Request $request, $contratista) {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'placa' => 'required|string|max:10',
        ]);

        Vehiculo::create([
            'id_contratista' => $contratista,
            'marca' => $request['marca'],
            'modelo' => $request['modelo'],
            'color' => $request['color'],
            'placa' => $request['placa'],
        ]);

        return redirect('/contratistas/vehiculo/'.$contratista)->with(['mensaje' => 'Información Creada']);
    }

    public function vehiculo_update(Request $request, $id) {
        $vehiculo = Vehiculo::find($id);

        $vehiculo->update([
            'id_contratista' => $vehiculo['id_contratista'],
            'marca' => $request['marca'] ? $request['marca'] : $vehiculo['marca'],
            'modelo' => $request['modelo'] ? $request['modelo'] : $vehiculo['modelo'],
            'color' => $request['color'] ? $request['color'] : $vehiculo['color'],
            'placa' => $request['placa'] ? $request['placa'] : $vehiculo['placa'],
        ]);

        return redirect('/contratistas/vehiculo/'.$vehiculo['id_contratista'])->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Documento
    public function documento_index($contratista) {
        $nombre_contratista = Contratista::find($contratista)->pluck('nombre_contratista')[0];
        $datos = Documento::where('id_contratista',$contratista)->get();
        return view('catalogo.documento.index', compact('datos','contratista','nombre_contratista'));
    }
    
    public function documento_create($contratista) {
        $nombre_contratista = Contratista::find($contratista)->pluck('nombre_contratista')[0];
        $empleados = Empleado::where('id_contratista',$contratista)->get();
        $vehiculos = Vehiculo::where('id_contratista',$contratista)->get();
        return view('catalogo.documento.create', compact('contratista','nombre_contratista','empleados','vehiculos'));
    }

    public function documento_view($id) {
        $dato = Documento::find($id);
        $nombre_contratista = Contratista::find($dato->id_contratista)->pluck('nombre_contratista')[0];
        return view('catalogo.documento.view', compact('dato','nombre_contratista'));
    }

    public function documento_edit($id) {
        $dato = Documento::find($id);
        $nombre_contratista = Contratista::find($dato->id_contratista)->pluck('nombre_contratista')[0];
        $empleados = Empleado::where('id_contratista',$dato->id_contratista)->get();
        $vehiculos = Vehiculo::where('id_contratista',$dato->id_contratista)->get();
        return view('catalogo.documento.edit', compact('dato','nombre_contratista','empleados','vehiculos'));
    }

    public function documento_store(Request $request, $contratista) {
        $request->validate([
            'id_empleado' => 'required|integer|exists:empleados,id',
            'id_vehiculo' => 'required|integer|exists:vehiculos,id',
            'fecha_vencimiento' => 'required|date|after_or_equal:today',
            'observacion' => 'nullable|string|max:500',
            'attach' => 'required|file|max:255',
        ]);

        if ($request->file('attach')) {
            $request->file('attach')->storeAs('documentos', $request->file('attach')->getClientOriginalName(), 'public');
        }

        Documento::create([
            'id_contratista' => $contratista,
            'id_empleado' => $request['id_empleado'],
            'id_vehiculo' => $request['id_vehiculo'],
            'fecha_vencimiento' => $request['fecha_vencimiento'],
            'observacion' => $request['observacion'],
            'attach' => $request->file('attach')->getClientOriginalName()
        ]);

        return redirect('/contratistas/documento/'.$contratista)->with(['mensaje' => 'Información Creada']);
    }

    public function documento_update(Request $request, $id) {
        $documento = Documento::find($id);

        // Declarando ruta del archivo a eliminar
        $archivo = 'public/documentos/'.$documento->attach;
        // Verificar si el existe archivo anterior y comprobar si el usuario pasó documento nuevo
        if (Storage::exists($archivo) && $request->file('attach')) {
            // Eliminar el archivo
            Storage::delete($archivo);
            // Creando el nuevo archivo
            $request->file('attach')->storeAs('documentos', $request->file('attach')->getClientOriginalName(), 'public');
        }

        $documento->update([
            'id_contratista' => $documento['id_contratista'],
            'id_empleado' => $request['id_empleado'] ? $request['id_empleado'] : $documento['id_empleado'],
            'id_vehiculo' => $request['id_vehiculo'] ? $request['id_vehiculo'] : $documento['id_vehiculo'],
            'fecha_vencimiento' => $request['fecha_vencimiento'] ? $request['fecha_vencimiento'] : $documento['fecha_vencimiento'],
            'observacion' => $request['observacion'] ? $request['observacion'] : $documento['observacion'],
            'attach' => $request['attach'] ? $request->file('attach')->getClientOriginalName() : $documento['attach']
        ]);

        return redirect('/contratistas/documento/'.$documento['id_contratista'])->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Equipo
    public function equipo_index($contratista) {
        $nombre_contratista = Contratista::find($contratista)->pluck('nombre_contratista')[0];
        $datos = Equipo::where('id_contratista',$contratista)->get();
        return view('catalogo.equipo.index', compact('datos','contratista','nombre_contratista'));
    }
    
    public function equipo_create($contratista) {
        $nombre_contratista = Contratista::find($contratista)->pluck('nombre_contratista')[0];
        $tipos_equipos = Tipo_equipo::all();
        return view('catalogo.equipo.create', compact('contratista','nombre_contratista','tipos_equipos'));
    }

    public function equipo_view($id) {
        $dato = Equipo::find($id);
        $nombre_contratista = Contratista::find($dato->id_contratista)->pluck('nombre_contratista')[0];
        return view('catalogo.equipo.view', compact('dato','nombre_contratista'));
    }

    public function equipo_edit($id) {
        $dato = Equipo::find($id);
        $nombre_contratista = Contratista::find($dato->id_contratista)->pluck('nombre_contratista')[0];
        $tipos_equipos = Tipo_equipo::all();
        return view('catalogo.equipo.edit', compact('dato','nombre_contratista','tipos_equipos'));
    }

    public function equipo_store(Request $request, $contratista) {
        $request->validate([
            'id_tipo_equipo' => 'required|integer|exists:tipo_equipos,id',
            'equipo' => 'required|string|max:255',
            'numero_serie' => 'required|string|max:255',
        ]);

        Equipo::create([
            'id_contratista' => $contratista,
            'id_tipo_equipo' => $request['id_tipo_equipo'],
            'equipo' => $request['equipo'],
            'numero_serie' => $request['numero_serie']
        ]);

        return redirect('/contratistas/equipo/'.$contratista)->with(['mensaje' => 'Información Creada']);
    }

    public function equipo_update(Request $request, $id) {
        $equipo = Equipo::find($id);

        $equipo->update([
            'id_contratista' => $equipo['id_contratista'],
            'id_tipo_equipo' => $request['id_tipo_equipo'] ? $request['id_tipo_equipo'] : $equipo['id_tipo_equipo'],
            'equipo' => $request['equipo'] ? $request['equipo'] : $equipo['equipo'],
            'numero_serie' => $request['numero_serie'] ? $request['numero_serie'] : $equipo['numero_serie']
        ]);

        return redirect('/contratistas/equipo/'.$equipo['id_contratista'])->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Tipo cédula
    public function tipo_cedula_index() {
        $datos = Tipo_cedula::all();
        return view('catalogo.tipo_cedula.index', compact('datos'));
    }
    
    public function tipo_cedula_create() {
        return view('catalogo.tipo_cedula.create');
    }

    public function tipo_cedula_view($id) {
        $dato = Tipo_cedula::find($id);
        return view('catalogo.tipo_cedula.view', compact('dato'));
    }

    public function tipo_cedula_edit($id) {
        $dato = Tipo_cedula::find($id);
        return view('catalogo.tipo_cedula.edit', compact('dato'));
    }

    public function tipo_cedula_store(Request $request) {
        $request->validate([
            'tipo_cedula' => 'required|string|max:255',
        ]);

        Tipo_cedula::create([
            'tipo_cedula' => $request['tipo_cedula']
        ]);

        return redirect('/tipos_cedulas')->with(['mensaje' => 'Información Creada']);
    }

    public function tipo_cedula_update(Request $request, $id) {
        $tipo_cedula = Tipo_cedula::find($id);

        $tipo_cedula->update([
            'tipo_cedula' => $request['tipo_cedula'] ? $request['tipo_cedula'] : $tipo_cedula['tipo_cedula']
        ]);

        return redirect('/tipos_cedulas')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Tipo documento
    public function tipo_documento_index() {
        $datos = Tipo_documento::all();
        return view('catalogo.tipo_documento.index', compact('datos'));
    }
    
    public function tipo_documento_create() {
        return view('catalogo.tipo_documento.create');
    }

    public function tipo_documento_view($id) {
        $dato = Tipo_documento::find($id);
        return view('catalogo.tipo_documento.view', compact('dato'));
    }

    public function tipo_documento_edit($id) {
        $dato = Tipo_documento::find($id);
        return view('catalogo.tipo_documento.edit', compact('dato'));
    }

    public function tipo_documento_store(Request $request) {
        $request->validate([
            'tipo_documento' => 'required|string|max:255',
        ]);

        Tipo_documento::create([
            'tipo_documento' => $request['tipo_documento']
        ]);

        return redirect('/tipos_documentos')->with(['mensaje' => 'Información Creada']);
    }

    public function tipo_documento_update(Request $request, $id) {
        $tipo_documento = Tipo_documento::find($id);

        $tipo_documento->update([
            'tipo_documento' => $request['tipo_documento'] ? $request['tipo_documento'] : $tipo_documento['tipo_documento']
        ]);

        return redirect('/tipos_documentos')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Tipo equipo
    public function tipo_equipo_index() {
        $datos = Tipo_equipo::all();
        return view('catalogo.tipo_equipo.index', compact('datos'));
    }
    
    public function tipo_equipo_create() {
        return view('catalogo.tipo_equipo.create');
    }

    public function tipo_equipo_view($id) {
        $dato = Tipo_equipo::find($id);
        return view('catalogo.tipo_equipo.view', compact('dato'));
    }

    public function tipo_equipo_edit($id) {
        $dato = Tipo_equipo::find($id);
        return view('catalogo.tipo_equipo.edit', compact('dato'));
    }

    public function tipo_equipo_store(Request $request) {
        $request->validate([
            'tipo_equipo' => 'required|string|max:255',
        ]);

        Tipo_equipo::create([
            'tipo_equipo' => $request['tipo_equipo']
        ]);

        return redirect('/tipos_equipos')->with(['mensaje' => 'Información Creada']);
    }

    public function tipo_equipo_update(Request $request, $id) {
        $tipo_equipo = Tipo_equipo::find($id);

        $tipo_equipo->update([
            'tipo_equipo' => $request['tipo_equipo'] ? $request['tipo_equipo'] : $tipo_equipo['tipo_equipo']
        ]);

        return redirect('/tipos_equipos')->with(['mensaje' => 'Información Actualizada']);
    }
}

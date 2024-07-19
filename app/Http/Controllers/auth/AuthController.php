<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $usuario = $request->validate([
            // 'name' => 'required|min:3',
            'email' => 'required|exists:users|email',
            'password' => 'required'
        ],[
            // 'name.required' => 'Escribe el nombre',
            // 'name.min' => 'Nombre mínimo de 3 carácteres',
            // 'email.unique' => 'El correo ya existe',
            'email.required' => 'Escribe el correo',
            'email.exists' => 'El email no es válido.',
            'password.required' => 'Escribe el password',
        ]);

        if (!auth()->attempt($request->only('email','password'), $request->remember)) {
            return back()->with('mensaje','Credenciales Incorrectas');
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}

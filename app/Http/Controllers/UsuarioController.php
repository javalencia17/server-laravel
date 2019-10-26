<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all();
        return response($usuarios);
    }

    
    public function store(Request $request)
    {
        
        $validarCorreo = Usuario::where('correo', $request->input('correo'))->first();

        if($validarCorreo){
            return "correo ya existe";        
        }

        $validarCedula = Usuario::where('cedula', $request->input('cedula'))->first();

        if($validarCedula){
            return "cédula ya existe";        
        }
        

        $usuario = new Usuario;
        $usuario->nombres = $request->input('nombres');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->cedula = $request->input('cedula');
        $usuario->correo = $request->input('correo');
        $usuario->telefono = $request->input('telefono');
        $usuario->save();

        return "ok";
    }

    public function update(Request $request, $id)
    {
        $usuario =  Usuario::find($id);
        $usuario->nombres = $request->input('nombres');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->cedula = $request->input('cedula');
        $usuario->correo = $request->input('correo');
        $usuario->telefono = $request->input('telefono');
        $usuario->save();

        return response('ok');
    }

    public function show($id)
    {
        $usuario =  Usuario::find($id);

        return response($usuario);
    }

    public function validarCorreo($correo)
    {
        $validar = Usuario::where('correo', $correo)->first();

        if($validar){
            return true;
        }else{
            return false;
        }

    }


}

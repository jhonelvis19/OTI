<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::latest()->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }


    public function create()
    {
        return view('admin.usuarios.create');
    }


    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',

            'apellido' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],

            'rol' => 'required'

        ], [

            'password.min' => 'La contraseña debe tener mínimo 8 caracteres.',

            'password.regex' => 'La contraseña debe contener mayúsculas, minúsculas y números.',

            'password.confirmed' => 'Las contraseñas no coinciden.'

        ]);


        User::create([

            'name' => $request->name,

            'apellido' => $request->apellido,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'rol' => $request->rol,

        ]);


        return redirect('/admin/usuarios')
            ->with('success', 'Usuario creado correctamente');
    }


    public function update(Request $request, User $usuario)
    {
        $request->validate([

            'name' => 'required|string|max:255',

            'apellido' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $usuario->id,

            'rol' => 'required|in:admin,usuario',

            'password' => [
                'nullable',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/'
            ],

        ]);


        $datos = [

            'name' => $request->name,

            'apellido' => $request->apellido,

            'email' => $request->email,

            'rol' => $request->rol,

        ];


        if($request->filled('password')) {

            $datos['password'] = bcrypt($request->password);

        }


        $usuario->update($datos);


        return redirect()
            ->back()
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $usuario)
    {
    $usuario->delete();

    return redirect()
        ->back()
        ->with('success', 'Usuario eliminado correctamente');
    }
    
    public function historial(User $usuario)
    {
    $informes = $usuario->informes()
        ->latest()
        ->get();

    return view(
        'admin.usuarios.historial',
        compact('usuario', 'informes')
    );
    }
}
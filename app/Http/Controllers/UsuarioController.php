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
            'rol' => 'required|in:admin,usuario'
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe superar los 255 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no debe superar los 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener mínimo 8 caracteres.',
            'password.regex' => 'La contraseña debe contener mayúsculas, minúsculas y números.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.in' => 'El rol seleccionado no es válido.'
        ]);

        User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario creado correctamente'
            ]);
        }

        return redirect('/admin/usuarios')
            ->with('success', 'Usuario creado correctamente')
            ->with('success_type', 'create');
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
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe superar los 255 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no debe superar los 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.in' => 'El rol seleccionado no es válido.',
            'password.min' => 'La nueva contraseña debe tener mínimo 8 caracteres.',
            'password.regex' => 'La nueva contraseña debe contener al menos una mayúscula y un número.'
        ]);

        $datos = [
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'rol' => $request->rol,
        ];

        if($request->filled('password')) {
            $datos['password'] = Hash::make($request->password);
        }

        $usuario->update($datos);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado correctamente'
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Usuario actualizado correctamente')
            ->with('success_type', 'edit')
            ->with('success_id', $usuario->id)
            ->with('success_name', $usuario->name)
            ->with('success_apellido', $usuario->apellido)
            ->with('success_email', $usuario->email)
            ->with('success_rol', $usuario->rol);
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
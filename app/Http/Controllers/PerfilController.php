<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function edit()
    {
        return view('configuraciones.perfil');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Si el correo está cambiando, requerimos la contraseña actual
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ];

        if ($request->email !== $user->email) {
            $rules['password_actual'] = ['required'];
        }

        $request->validate($rules);

        if ($request->email !== $user->email) {
            if (!Hash::check($request->password_actual, $user->password)) {
                return back()->withErrors(['password_actual' => 'La contraseña actual es incorrecta.']);
            }
        }

        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Los datos del perfil se actualizaron correctamente.');
    }
}

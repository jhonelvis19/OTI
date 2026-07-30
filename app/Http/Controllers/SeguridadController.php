<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SeguridadController extends Controller
{
    public function edit()
    {
        return view('configuraciones.seguridad');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password_actual' => ['required'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
            ],
        ]);

        if (!Hash::check($request->password_actual, auth()->user()->password)) {
            return back()->withErrors([
                'password_actual' => 'La contraseña actual es incorrecta.',
            ]);
        }

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'La contraseña se actualizó correctamente.');
    }
}

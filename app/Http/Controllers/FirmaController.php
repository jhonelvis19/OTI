<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FirmaController extends Controller
{
    public function guardarFirmaPerfil(Request $request)
    {
        $user = Auth::user();

        // Validar contraseña actual
        $request->validate([
            'password_confirmacion' => 'required',
            'metodo_firma' => 'required|in:dibujada,foto',
        ], [
            'password_confirmacion.required' => 'Debe ingresar su contraseña actual para confirmar el cambio.',
            'metodo_firma.required' => 'Debe especificar el método de firma.',
        ]);

        if (!Hash::check($request->password_confirmacion, $user->password)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'La contraseña ingresada es incorrecta.'
                ], 422);
            }
            return back()->withErrors(['password_confirmacion' => 'La contraseña ingresada es incorrecta.']);
        }

        $firmaPath = null;

        if ($request->metodo_firma === 'dibujada') {
            $request->validate([
                'firma_base64' => 'required|string',
            ], [
                'firma_base64.required' => 'Debe dibujar su firma en pantalla.',
            ]);

            // Decodificar Base64
            $data = $request->firma_base64;
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, jpeg

                if (!in_array($type, ['png', 'jpg', 'jpeg', 'webp'])) {
                    return response()->json(['success' => false, 'message' => 'Formato de imagen inválido.'], 400);
                }

                $data = str_replace(' ', '+', $data);
                $data = base64_decode($data);

                if ($data === false) {
                    return response()->json(['success' => false, 'message' => 'Error al decodificar la firma.'], 400);
                }

                // Generar nombre de archivo
                $filename = 'firmas/usuarios/usuario_' . $user->id . '.png';
                Storage::disk('public')->put($filename, $data);
                $firmaPath = $filename;
            } else {
                return response()->json(['success' => false, 'message' => 'Datos de firma inválidos.'], 400);
            }
        } elseif ($request->metodo_firma === 'foto') {
            $request->validate([
                'firma_foto' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            ], [
                'firma_foto.required' => 'Debe tomar una fotografía de su firma.',
                'firma_foto.image' => 'El archivo debe ser una imagen válida.',
                'firma_foto.mimes' => 'Formatos permitidos: JPEG, JPG, PNG, WebP.',
                'firma_foto.max' => 'La imagen no debe superar los 2MB.',
            ]);

            // Guardar archivo
            $file = $request->file('firma_foto');
            $filename = 'usuario_' . $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('firmas/usuarios', $filename, 'public');
            $firmaPath = $path;
        }

        if ($firmaPath) {
            $user->update([
                'firma' => $firmaPath,
                'firma_actualizada_en' => now(),
            ]);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Firma registrada correctamente en su perfil.',
                    'firma_url' => asset('storage/' . $firmaPath)
                ]);
            }

            return back()->with('success', 'Firma registrada correctamente en su perfil.');
        }

        return back()->withErrors(['error' => 'No se pudo guardar la firma.']);
    }

    public function eliminarFirmaPerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password_confirmacion' => 'required',
        ], [
            'password_confirmacion.required' => 'Debe ingresar su contraseña actual para confirmar la eliminación.',
        ]);

        if (!Hash::check($request->password_confirmacion, $user->password)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'La contraseña ingresada es incorrecta.'
                ], 422);
            }
            return back()->withErrors(['password_confirmacion' => 'La contraseña ingresada es incorrecta.']);
        }

        if ($user->firma) {
            Storage::disk('public')->delete($user->firma);
            $user->update([
                'firma' => null,
                'firma_actualizada_en' => null,
            ]);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Firma eliminada de su perfil.'
            ]);
        }

        return back()->with('success', 'Firma eliminada de su perfil.');
    }
}

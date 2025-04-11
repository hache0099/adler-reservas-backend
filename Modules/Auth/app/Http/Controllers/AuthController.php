<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\{User, Persona, Domicilio, PersonaDocumento, PersonaContacto, TipoContacto, TipoDocumento, TipoDomicilio, Perfile};

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user]);
        }

        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    /**
    * Registra un nuevo usuario con todos los datos relacionados.
    * 
    * Datos requeridos en el request (JSON):
    * {
    *   "email": "correo@ejemplo.com",
    *   "password": "contraseña123",
    *   "password_confirmation": "contraseña123",
    *   "name": "Juan",
    *   "apellido": "Pérez",
    *   "telefono": "1234567890",
    *   "tipodni": 1,
    *   "dni": "12345678",
    *   "domicilio": "Calle Falsa 123",
    *   "fechanac": "1990-01-01"
    * }
    * 
    * Respuestas:
    * - 201: Usuario creado correctamente
    * - 422: Errores de validación
    * - 500: Error interno del servidor
    */

    public function register(Request $request)
    {
        // Validación con el método integrado de Request
        $validated = $request->validate([
            'email' => 'required|string|email|max:55|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'required|numeric',
            'tipodni' => 'required|numeric|min:1|exists:tipo_documentos,id',
            'dni' => 'required|numeric|unique:persona_documentos,descripcion',
            'domicilio' => 'required|string|max:100',
            'fechanac' => 'required|date|before:-18 years', // +18 años
        ]);

        try {
            DB::beginTransaction();
            
            // 1. Crear persona
            $persona = Persona::create([
                'nombre' => $validated['name'],
                'apellido' => $validated['apellido'],
                'fecha_nacimiento' => $validated['fechanac'],
            ]);

            // 2. Crear domicilio
            Domicilio::create([
                'detalle' => $validated['domicilio'],
                'persona_id' => $persona->id,
                'tipo_domicilio_id' => 1, // Valor por defecto
            ]);

            // 3. Crear documento
            PersonaDocumento::create([
                'descripcion' => $validated['dni'],
                'persona_id' => $persona->id,
                'tipo_documento_id' => $validated['tipodni'],
            ]);

            // 4. Crear contacto (teléfono)
            PersonaContacto::create([
                'descripcion' => $validated['telefono'],
                'persona_id' => $persona->id,
                'tipo_contacto_id' => TipoContacto::where('descripcion', 'Telefono')->first()->id,
            ]);
            
            // 5. Crear usuario
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'persona_id' => $persona->id,
                'perfil_id' => Perfile::where('descripcion', 'usuario')->value('id'),
                'fecha_alta' => now(),
                'password_changed' => 1,
            ]);
            
            DB::commit();

            // Respuesta exitosa
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('auth_token')->plainTextToken
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error en el registro',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }


    public function getTiposDocumento()
    {
        return TipoDocumento::where('estado', 1)->get(['id', 'descripcion']);
    }

    public function getTablasMaestras()
    {
        return response()->json([
            'tipo-contacto' => TipoContacto::where('estado', 1)->get(['id', 'descripcion']),
            'tipo-documento' => TipoDocumento::where('estado', 1)->get(['id', 'descripcion']),
            'tipo-domicilio' => TipoDomicilio::where('estado', 1)->get(['id', 'descripcion']),
        ], 201);
    }


    public function checkEmailExists(Request $request)
    {
        
        return response()->json([
            'exists' => User::where('email', $request->email)->exists(),
        ]);
    }
}

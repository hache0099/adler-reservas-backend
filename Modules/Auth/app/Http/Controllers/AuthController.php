<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\{User, Persona, Domicilio, PersonaDocumento, PersonaContacto, TipoContacto, TipoDocumento, TipoDomicilio, Perfile};

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered; 

use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;


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
            $user = User::where('email', $request->email)->with(['persona:id,nombre,apellido'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
				'token' => $token, 
				'user' => $user,
				'verified' => $user->hasVerifiedEmail() 
			]);
        }

        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    public function logout(Request $request)
    {
        $user = User::where('email', $request->email)->first();
		$user->tokens()->delete();
        //Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada'],200);
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
			
          // 6. GENERAR TOKEN Y DISPARAR EVENTO
            $user->verification_token = Str::uuid()->toString();
            $user->save();

            event(new UserRegistered($user));
            
            DB::commit();

            // Respuesta exitosa
            return response()->json([
                'user' => $user,
                //'token' => $user->createToken('auth_token')->plainTextToken
				'message' => 'Registro exitoso. Por favor, revisa tu correo para verificar tu cuenta.',
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error en el registro',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
	
	 /**
     * Reenvía el correo de verificación al usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendVerificationEmail(Request $request)
    {
        // 1. Validar que el email fue enviado y es un formato de email válido.
        $request->validate([
            'email' => 'required|email',
        ]);

        // 2. Buscar al usuario por el email proporcionado.
        $user = User::where('email', $request->email)->first();

        // 3. Manejar el caso en que el usuario no exista.
        if (!$user) {
            return response()->json([
                'message' => 'No se encontró un usuario con esa dirección de correo electrónico.'
            ], 404); // Not Found
        }

        // 4. Comprobar si el correo del usuario ya ha sido verificado.
        if ($user->hasVerifiedEmail()) { // Laravel provee este método útil
            return response()->json([
                'message' => 'Esta dirección de correo electrónico ya ha sido verificada.'
            ], 400); // Bad Request
        }

        // 5. Generar un nuevo token, guardarlo y disparar el evento.
        try {
            // Generamos un nuevo token para invalidar cualquier enlace anterior.
            $user->verification_token = Str::uuid()->toString();
            $user->save();
            
            // Disparamos el mismo evento que en el registro.
            // El listener SendVerificationEmail se encargará de enviar el correo.
            event(new UserRegistered($user));

            return response()->json([
                'message' => 'Se ha enviado un nuevo enlace de verificación a tu correo electrónico.'
            ]);

        } catch (\Throwable $e) {
            // Manejo de errores en caso de que falle el envío o el guardado en la BD.
            // Es bueno loguear el error para depuración.
            \Log::error('Error al reenviar email de verificación: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al intentar reenviar el correo. Por favor, inténtalo más tarde.',
                'error' => $e->getMessage(),
            ], 500); // Internal Server Error
        }
    }
  
   public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        // Si no se encuentra el usuario o el token es nulo
        if (!$user) {
            // Redirigir al frontend con un error
            return redirect(env('FRONTEND_URL') . '/login?verified=false&error=invalid_token');
        }

        // Marcar al usuario como verificado y borrar el token
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        // Redirigir al frontend con éxito
        return redirect(env('FRONTEND_URL') . '/login?verified=true');
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
        $request->validate([
            'email' => 'required|email',
        ]);
        
        $emailExists = User::where('email', $request->email)
                        //->where('estado', 1)
                        ->exists();
                        
        return response()->json([
            'exists' => $emailExists,
        ]);
    }

    public function resetUserPassword($id) {
        $user = User::with('persona.persona_documento')->findOrFail($id);

        $user->update(['password' => Hash::make($user->persona->persona_documento->descripcion)]);

        return response()->json([], 200);
    }

    public function sendPasswordEmail(Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => '¡Enlace de reseteo enviado!'], 200)
            : response()->json(['message' => 'No se puede enviar el enlace de reseteo.'], 400);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset($request->all(), function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password)
            ])->save();
        });

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => '¡Contraseña reseteada con éxito!'], 200)
            : response()->json(['message' => 'Token inválido.'], 400);
    }
}

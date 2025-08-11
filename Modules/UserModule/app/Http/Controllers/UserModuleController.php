<?php

namespace Modules\UserModule\Http\Controllers;

use App\Models\{User, Persona, PersonaContacto, PersonaDocumento, TipoDocumento, Domicilio};
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::with(['perfile' ,'persona.persona_documento'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usermodule::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        
        return response()->json(
            User::select('id', 'email', 'persona_id', 'perfil_id')
            ->with([
                'persona:id,nombre,apellido,fecha_nacimiento',
                'persona.persona_documento:id,descripcion,persona_id,tipo_documento_id',
                'persona.persona_documento.tipo_documento:id,descripcion',
                'persona.domicilio:id,detalle,persona_id,tipo_domicilio_id',
                'persona.domicilio.tipo_domicilio:id,descripcion',
                'persona.persona_contactos:id,descripcion,persona_id,tipo_contacto_id',
                'persona.persona_contactos.tipo_contacto:id,descripcion'
            ])
            ->findOrFail($id)
        );
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8'
        ]);
        $user = User::findOrFail($request->id);
        //return $request;

         if(!Hash::check($request->currentPassword, $user->password))
        {
            return response()->json(['current_password' => 'Contraseña incorrecta'], 400);
        }
        
        
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json(['success' => 'La contraseña se ha cambiado con éxito'], 200);
    }

    public function updatePerfil(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'perfil_id' => 'required|numeric',
        ]);
         DB::beginTransaction();

        try {
            $user->update([
                'perfil_id' => $request->perfil_id,
            ]);

            DB::commit();

            return response()->json(['mensaje' => 'se ha actualizado correctamente'],200);
        } catch (Throwable $e) {
            DB::rollBack();

            return response()->json(['mensaje' => "Hubo un error: $e->getMessage()"],400);
        }
        
        
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) 
    {
        $user = User::findOrFail($id);
        
        // Validar los datos recibidos usando $request->validate()
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'apellido' => 'sometimes|required|string|max:100',
            'fecha_nacimiento' => 'sometimes|required|date',
            
            'documento.tipo_documento_id' => 'sometimes|required|exists:tipo_documentos,id',
            'documento.descripcion' => 'sometimes|required|string|max:20',
            
            'contacto.tipo_contacto_id' => 'sometimes|required|exists:tipo_contactos,id',
            'contacto.descripcion' => 'sometimes|required|string|max:50',
            
            'domicilio.detalle' => 'sometimes|required|string|max:255',
            'domicilio.tipo_domicilio_id' => 'sometimes|required|exists:tipo_domicilios,id',
            'perfil_id' => 'sometimes|numeric',
        ]);

        // Iniciar transacción para asegurar la integridad de los datos
        DB::beginTransaction();
        
        try {
        
            // Actualizar datos personales
            if ($request->hasAny(['nombre', 'apellido', 'fecha_nacimiento'])) {
                $user->persona->update([
                    'nombre' => $request->input('nombre', $user->persona->nombre),
                    'apellido' => $request->input('apellido', $user->persona->apellido),
                    'fecha_nacimiento' => $request->input('fecha_nacimiento', $user->persona->fecha_nacimiento)
                ]);
            }

            // Actualizar documento
            if ($request->has('documento')) {
                $user->persona->persona_documento()->updateOrCreate(
                    ['persona_id' => $user->persona->id],
                    [
                        'tipo_documento_id' => $validatedData['documento']['tipo_documento_id'],
                        'descripcion' => $validatedData['documento']['descripcion']
                    ]
                );
            }

            // Actualizar contacto (teléfono)
            if ($request->has('contacto')) {
                $telefonoContacto = $user->persona->persona_contactos()
                    ->whereHas('tipo_contacto', function($q) {
                        $q->where('descripcion', 'like', '%telefono%');
                    })
                    ->first();
                
                if ($telefonoContacto) {
                    $telefonoContacto->update([
                        'tipo_contacto_id' => $validatedData['contacto']['tipo_contacto_id'],
                        'descripcion' => $validatedData['contacto']['descripcion']
                    ]);
                } else {
                    $user->persona->persona_contactos()->create([
                        'tipo_contacto_id' => $validatedData['contacto']['tipo_contacto_id'],
                        'descripcion' => $validatedData['contacto']['descripcion']
                    ]);
                }
            }

            // Actualizar domicilio
            if ($request->has('domicilio')) {
                $user->persona->domicilio()->updateOrCreate(
                    ['persona_id' => $user->persona->id],
                    [
                        'tipo_domicilio_id' => $validatedData['domicilio']['tipo_domicilio_id'],
                        'detalle' => $validatedData['domicilio']['detalle']
                    ]
                );
            }

            DB::commit();

            // Cargar todas las relaciones actualizadas
            $user->load([
                'persona.persona_documento.tipo_documento',
                'persona.domicilio.tipo_domicilio',
                'persona.persona_contactos.tipo_contacto'
            ]);

            return response()->json($user);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el perfil',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|numeric',
        ]);

        $user = User::findOrFail($id);

        DB::beginTransaction();
        try{
            $user->update([
                'estado' => $request->estado,
            ]);
            DB::commit();

            return response()->json([
                'success' => 'se ha cambiado el estado con exito'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el perfil',
                'error' => $e->getMessage()
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}

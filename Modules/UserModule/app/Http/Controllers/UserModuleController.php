<?php

namespace Modules\UserModule\Http\Controllers;

use App\Models\{User, Persona, PersonaContacto, PersonaDocumento, TipoDocumento};
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('usermodule::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}

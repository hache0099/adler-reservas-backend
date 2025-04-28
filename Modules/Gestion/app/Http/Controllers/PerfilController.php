<?php

namespace Modules\Gestion\Http\Controllers;

use App\Models\{Perfile, Modulo, PerfilModulo};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        return response()->json(Perfile::with([
            'perfil_modulos.modulo',
        ])->get(['id', 'descripcion'])
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        return response()->json([]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        //

        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'modulos' => 'required|array',
        ]);

        $perfil = Perfile::find($id);
        
        try {
            DB::beginTransaction();
            PerfilModulo::destroy($perfil->perfil_modulos->modelKeys());

            foreach($request->modulos as $idModulo)
            {
                PerfilModulo::create([
                    'perfil_id' => $id,
                    'modulo_id' => $idModulo,
                ]);
            }

            DB::commit();
            return Perfile::with([
                'perfil_modulos.modulo',
            ])
            ->get(['id', 'descripcion']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => "Hubo un error: $e->getMessage()"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}

<?php

namespace Modules\Gestion\Http\Controllers;

use App\Models\TipoCancha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiposCanchaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        return response()->json(TipoCancha::all(['id', 'material', 'estado']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'descripcion' => 'required',
            'estado' => 'required|numeric|min:0|max:1',
        ]);

        TipoCancha::create([
            'material' => $request->descripcion,
            'estado' => $request->estado,
        ]);
        
        
        response()->json(TipoCancha::all(['id', 'material', 'estado']));
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
        $tipoDoc = TipoCancha::find($id);

        $request->validate([
            'material' => 'required',
            'estado' => 'required',
        ]);

        $tipoDoc->update([
            'material' => $request->material,
            'estado' => $request->estado,
        ]);
        
        response()->json(TipoCancha::all(['id', 'material', 'estado']));
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

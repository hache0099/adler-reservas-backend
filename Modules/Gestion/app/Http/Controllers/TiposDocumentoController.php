<?php

namespace Modules\Gestion\Http\Controllers;

use App\Models\TipoDocumento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiposDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        return response()->json(TipoDocumento::all(['id', 'descripcion', 'estado']));
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

        TipoDocumento::create([
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);
        
        
        response()->json(TipoDocumento::all(['id', 'descripcion', 'estado']));
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
        $tipoDoc = TipoDocumento::find($id);

        $tipoDoc->update($request->all());
        
        response()->json(TipoDocumento::all(['id', 'descripcion', 'estado']));
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

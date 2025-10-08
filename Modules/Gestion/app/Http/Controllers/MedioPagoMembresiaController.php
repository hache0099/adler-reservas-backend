<?php

namespace Modules\Gestion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MedioPagoMembresium;

class MedioPagoMembresiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MedioPagoMembresium::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gestion::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
		
		
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('gestion::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('gestion::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		$tipoPago = MedioPagoMembresium::find($id);

        $tipoPago->update($request->all());
		
		return response()->json(['message' => 'Se ha actualizado con éxito'],200);
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}

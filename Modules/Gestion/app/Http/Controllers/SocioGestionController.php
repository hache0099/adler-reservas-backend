<?php

namespace Modules\Gestion\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{Socio, User, MembresiaMe, PagoMembresium, ConfirmacionPagoEfectivo};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SocioGestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate(['dni' => 'nullable|string|max:20']);
        
        $query = Socio::query()->with('user.persona.persona_documento', 'estado_membresium');

        if ($request->has('dni') && $request->dni) {
            $dni = $request->dni;
            $query->whereHas('user.persona.persona_documento', function ($q) use ($dni) {
                $q->where('descripcion', 'like', "%{$dni}%");
            });
        }

        return $query->get();
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
        $socio = Socio::find($id);
        $socio->load([
            'membresia_mes' => function ($query) {
                $query->orderBy('anio', 'desc')->orderBy('mes', 'desc');
            }, 
            'membresia_mes.pago_membresia.confirmacion.user.persona'
        ]);
        return $socio;
    }
    
    public function confirmarPagoEfectivo(Request $request)
    {
        $validated = $request->validate([
            'membresia_mes_id' => 'required|exists:membresia_mes,id',
        ]);
        
        $empleado = User::findOrFail($request->userId);
        $membresiaMes = MembresiaMe::findOrFail($validated['membresia_mes_id']);
        
        if ($membresiaMes->monto_pagado >= $membresiaMes->monto_a_pagar) {
            return response()->json(['message' => 'Esta cuota ya ha sido pagada en su totalidad.'], 409);
        }

        DB::beginTransaction();
        try {
            $montoAPagar = $membresiaMes->monto_a_pagar - $membresiaMes->monto_pagado;

            $pago = PagoMembresium::create([
                'membresia_mes_id' => $membresiaMes->id,
                'monto' => $montoAPagar,
                'medio_pago_membresia_id' => 1, // Efectivo
                'fecha' => now(),
            ]);

            ConfirmacionPagoEfectivo::create([
                'pago_membresia_id' => $pago->id,
                'user_id' => $empleado->id,
            ]);

            $membresiaMes->monto_pagado = $membresiaMes->monto_a_pagar;
            
            if ($membresiaMes->socio->estado_membresia_id == 2) {
                $membresiaMes->socio->estado_membresia_id = 1;
            }
            
            $membresiaMes->socio->save();
            $membresiaMes->save();
            
            DB::commit();
            return response()->json(['message' => 'Pago confirmado exitosamente.']);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al confirmar pago: " . $e->getMessage());
            return response()->json(['message' => 'Error interno al confirmar el pago.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
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

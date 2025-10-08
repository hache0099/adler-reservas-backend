<?php

namespace Modules\Socio\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{User, Socio, PrecioMembresium, MembresiaMe};
use Carbon\Carbon;

class MembresiaController extends Controller
{
  
    public function subscribe(Request $request)
    {
        $user = User::findOrFail($request->id);

        // Evitar que un usuario se haga socio dos veces
        if (Socio::where('users_id', $user->id)->exists()) {
            return response()->json(['message' => 'Ya eres socio.'], 409); // Conflict
        }
        
        // Asumimos estado 2 = "Pendiente de Pago Inicial"
        $socio = new Socio();
        $socio->users_id = $user->id;
        $socio->fecha_alta = now();
        $socio->estado_membresia_id = 2; // Pendiente
        $socio->save();
        
        // Generar la primera cuota
        $hoy = Carbon::now();
        $precioVigente = PrecioMembresium::where('fecha_desde', '<=', $hoy)
            ->where(function ($q) use ($hoy) { $q->where('fecha_hasta', '>=', $hoy)->orWhereNull('fecha_hasta'); })
            ->latest('fecha_desde')->first();

        if ($precioVigente) {
            MembresiaMe::create([
                'socio_id' => $socio->id,
                'mes' => $hoy->month,
                'anio' => $hoy->year,
                'monto_a_pagar' => $precioVigente->precio,
                'monto_pagado' => 0.00,
                'precio_membresia_id' => $precioVigente->id,
            ]);
        }
        
        return response()->json([
            'message' => '¡Suscripción iniciada! Tienes hasta fin de mes para realizar tu primer pago.'
        ], 201);
    }
    
    public function status(Request $request)
    {
        //dd($request->userId);
        $user = User::find($request->userId);
        $socio = Socio::where('users_id', $user->id)
                      ->with('estado_membresium') // Cargar el estado
                      ->first();

        if ($socio) {
            return response()->json([
                'esSocio' => true,
                'userId' => $user->id,
                'fecha_alta' => $socio->fecha_alta,
                'estado' => $socio->estado_membresium->descripcion,
            ]);
        }

        return response()->json(['esSocio' => false]);
    }


    public function getPrecioActual()
    {
        $hoy = Carbon::now();
        $precioVigente = PrecioMembresium::where('fecha_desde', '<=', $hoy)
            ->where(function ($q) use ($hoy) { $q->where('fecha_hasta', '>=', $hoy)->orWhereNull('fecha_hasta'); })
            ->latest('fecha_desde')->first();

        if ($precioVigente) {
            return response()->json([
                'precio' => $precioVigente->precio,
            ]);
        }

        return response()->json(['precio' => 'No disponible'], 404);
    }
    
    
    public function getHistorialPagos(Request $request)
    {
        $user = User::find($request->userId);
        $socio = Socio::where('users_id', $user->id)->first();

        if (!$socio) {
            return response()->json(['message' => 'El usuario actual no es un socio.'], 404);
        }

        // Cargar las cuotas mensuales del socio, ordenadas de más reciente a más antigua.
        // También cargamos los pagos de cada cuota y la información del empleado que confirmó (si existe).
        $membresias = MembresiaMe::where('socio_id', $socio->id)
            ->with(['pago_membresia.confirmacion.user.persona'])
            ->orderBy('anio', 'desc')
            ->orderBy('mes', 'desc')
            ->get();

        return response()->json($membresias);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return response()->json([]);
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

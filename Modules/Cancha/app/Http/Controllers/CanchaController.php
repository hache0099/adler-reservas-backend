<?php

namespace Modules\Cancha\Http\Controllers;

use App\Models\{Cancha, TipoCancha, HorarioCancha};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CanchaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cancha::with([
            'tipo_cancha:id,material', 
            'estado_cancha:id,descripcion',
            'horario_canchas:id,hora_desde,hora_hasta,cancha_id',
        ])
        ->get(['id', 'max_personas', 'tipo_cancha_id','estado_cancha_id','ubicacion_descripcion',]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'max_personas' => 'required|integer|min:1',
            'tipo_cancha_id' => 'required|exists:tipo_canchas,id',
            'estado_cancha_id' => 'required|exists:estado_canchas,id',
            'hora_desde' => 'required|integer|min:0|max:23',
            'hora_hasta' => 'required|integer|min:1|max:23|gt:hora_desde',
			'ubicacion_descripcion' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $cancha = Cancha::create([
                'max_personas' => $validated['max_personas'],
                'tipo_cancha_id' => $validated['tipo_cancha_id'],
                'estado_cancha_id' => $validated['estado_cancha_id'],
				'ubicacion_descripcion' => $validated['ubicacion_descripcion'] ?? null,
            ]);

            HorarioCancha::create([
                'hora_desde' => $validated['hora_desde'],
                'hora_hasta' => $validated['hora_hasta'],
                'cancha_id' => $cancha->id,
            ]);

            DB::commit();
            return response()->json($cancha->load('tipo_cancha', 'estado_cancha'), 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => "Error al crear cancha: $e"], 500);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('cancha::show');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'max_personas' => 'required|integer|min:1',
            'tipo_cancha_id' => 'required|exists:tipo_canchas,id',
            'estado_cancha_id' => 'required|exists:estado_canchas,id',
            'hora_desde' => 'required|integer|min:0|max:23',
            'hora_hasta' => 'required|integer|min:1|max:23|gt:hora_desde',
			'ubicacion_descripcion' => 'nullable|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            $cancha = Cancha::findOrFail($id);
            $cancha->update([
                'max_personas' => $validated['max_personas'],
                'tipo_cancha_id' => $validated['tipo_cancha_id'],
                'estado_cancha_id' => $validated['estado_cancha_id'],
				'ubicacion_descripcion' => $validated['ubicacion_descripcion'] ?? null,
            ]);

            $horario = HorarioCancha::where('cancha_id', $cancha->id)->first();
            if ($horario) {
                $horario->update([
                    'hora_desde' => $validated['hora_desde'],
                    'hora_hasta' => $validated['hora_hasta'],
                ]);
            } else {
                HorarioCancha::create([
                    'hora_desde' => $validated['hora_desde'],
                    'hora_hasta' => $validated['hora_hasta'],
                    'cancha_id' => $cancha->id,
                ]);
            }

            DB::commit();
            return response()->json($cancha->load('tipo_cancha', 'estado_cancha', 'horario_canchas'), 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar cancha'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}

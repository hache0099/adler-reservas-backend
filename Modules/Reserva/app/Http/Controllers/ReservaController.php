<?php

namespace Modules\Reserva\Http\Controllers;

use App\Models\{Reserva, Cancha, PorcentajeSena};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Carbon;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Reserva::paginate(15);
    }

    public function getCanchasDisponibles(Request $request){
        //dd($request);
        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|numeric',
        ]);

        $reservas = Reserva::where([
            'fecha' => $validated["fecha"],
            'hora' => $validated["hora"],
        ])
        ->get();

        //dd($reservas->pluck('cancha_id')->toArray());
        
        $canchas = Cancha::where('estado_cancha_id', 1)
            ->whereHas('horario_canchas', function($query) use ($validated) {
                $query->where('hora_desde', '<=', $validated["hora"])
                      ->where('hora_hasta', '>=', $validated["hora"]);
            })
            ->with(['precio_actual', 'tipo_cancha', 'horario_canchas'])
            ->get()
            ->reject(function (Cancha $cancha) use ($reservas) {
                return in_array($cancha->id, $reservas->pluck('cancha_id')->toArray());
            });

        return $canchas;
    }

    public function getReservaByUser(Request $request, $id)
    {
        
        return Reserva::where('user_id', $id)
            ->with([
                'estado_pago', 
                'estado_reserva', 
                'cancha.tipo_cancha'
            ])
            ->get();
    }

    public function getReservaPendienteByUser(Request $request, $id)
    {
        //dd(now()->toDateString());
        return Reserva::where('user_id', $id)
            ->where('fecha', '>=', now()->toDateString())
            ->with([
                'estado_pago', 
                'estado_reserva', 
                'cancha.tipo_cancha'
            ])
            ->get();
    }

    public function getTodasReservasByUser(Request $request, $id)
    {
        return Reserva::where('user_id', $id)
            ->with([
                'estado_pago', 
                'estado_reserva', 
                'cancha.tipo_cancha'
            ])
            ->get();
    }

    public function getReservasByDate(Request $request)
    {
        $request->validate([
            'fecha' => 'sometimes|required|date',
        ]);

        $fecha = $request->fecha !== null ? $request->fecha : now()->toDateString();
        $hora = now()->hour;
        return Reserva::where(function($query) use ($fecha, $hora) {
                $query->where('fecha', $fecha)
                ->where('hora', '>=', $hora);
            })
            ->with([
                'estado_pago', 
                'estado_reserva', 
                'cancha.tipo_cancha',
                'user.persona.persona_documento',
            ])
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return Cancha::with(['tipos_cancha', 'cancha_estado', 'precio_cancha'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //return $request->all();
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'cancha' => 'required',
            'user' => 'required',
        ]);

        $cancha = Cancha::find($request->cancha);
        //$porc_sena = PorcentajeSena::latest('fecha_desde')->first();

        try{
            $nuevaReservaid = Reserva::create([
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'cancha_id' => $request->cancha,
                'user_id' => $request->user,
                'porcentaje_sena_id' => 1,
                'monto_total' => $cancha->precio_actual->precio,
            ]);
            return $nuevaReservaid;
        } catch (Throwable $e) {
            return response(400)->json(['error' => $e->getMessage()]);
        }
        
    }


}

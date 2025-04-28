<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Cancha;
use App\Models\EstadoPago;
use App\Models\EstadoReserva;
use App\Models\IngresoEgreso;
use App\Models\PorcentajeSena;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reserva
 * 
 * @property int $id
 * @property Carbon $fecha
 * @property int $hora
 * @property float $monto_total
 * @property float|null $monto_pagado
 * @property int $estado_reserva_id
 * @property int $user_id
 * @property int $cancha_id
 * @property int $estado_pago_id
 * @property int $porcentaje_sena_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cancha $cancha
 * @property EstadoPago $estado_pago
 * @property EstadoReserva $estado_reserva
 * @property PorcentajeSena $porcentaje_sena
 * @property User $user
 * @property Collection|IngresoEgreso[] $ingreso_egresos
 *
 * @package App\Models\Base
 */
class Reserva extends Model
{
	protected $table = 'reservas';

	protected $casts = [
		'fecha' => 'datetime',
		'hora' => 'int',
		'monto_total' => 'float',
		'monto_pagado' => 'float',
		'estado_reserva_id' => 'int',
		'user_id' => 'int',
		'cancha_id' => 'int',
		'estado_pago_id' => 'int',
		'porcentaje_sena_id' => 'int'
	];

	public function cancha()
	{
		return $this->belongsTo(Cancha::class);
	}

	public function estado_pago()
	{
		return $this->belongsTo(EstadoPago::class);
	}

	public function estado_reserva()
	{
		return $this->belongsTo(EstadoReserva::class);
	}

	public function porcentaje_sena()
	{
		return $this->belongsTo(PorcentajeSena::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function ingreso_egresos()
	{
		return $this->hasMany(IngresoEgreso::class);
	}
}

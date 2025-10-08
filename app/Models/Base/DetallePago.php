<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\MetodoPago;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetallePago
 * 
 * @property int $id
 * @property float|null $monto
 * @property Carbon|null $fecha_hora
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $reservas_id
 * @property int $metodo_pagos_id
 * 
 * @property MetodoPago $metodo_pago
 * @property Reserva $reserva
 *
 * @package App\Models\Base
 */
class DetallePago extends Model
{
	protected $table = 'detalle_pagos';

	protected $casts = [
		'monto' => 'float',
		'fecha_hora' => 'datetime',
		'reservas_id' => 'int',
		'metodo_pagos_id' => 'int'
	];

	public function metodo_pago()
	{
		return $this->belongsTo(MetodoPago::class, 'metodo_pagos_id');
	}

	public function reserva()
	{
		return $this->belongsTo(Reserva::class, 'reservas_id');
	}
}

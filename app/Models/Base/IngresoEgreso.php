<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IngresoEgreso
 * 
 * @property int $id
 * @property string $tipo_evento
 * @property Carbon|null $fecha_hora
 * @property int $reserva_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Reserva $reserva
 *
 * @package App\Models\Base
 */
class IngresoEgreso extends Model
{
	protected $table = 'ingreso_egresos';

	protected $casts = [
		'fecha_hora' => 'datetime',
		'reserva_id' => 'int'
	];

	public function reserva()
	{
		return $this->belongsTo(Reserva::class);
	}
}

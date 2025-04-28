<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PorcentajeSena
 * 
 * @property int $id
 * @property float|null $porcentaje
 * @property Carbon|null $fecha_desde
 * @property Carbon|null $fecha_hasta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Reserva[] $reservas
 *
 * @package App\Models\Base
 */
class PorcentajeSena extends Model
{
	protected $table = 'porcentaje_senas';

	protected $casts = [
		'porcentaje' => 'float',
		'fecha_desde' => 'datetime',
		'fecha_hasta' => 'datetime'
	];

	public function reservas()
	{
		return $this->hasMany(Reserva::class);
	}
}

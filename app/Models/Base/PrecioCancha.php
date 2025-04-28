<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Cancha;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrecioCancha
 * 
 * @property int $id
 * @property float $precio
 * @property Carbon $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property int $cancha_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cancha $cancha
 *
 * @package App\Models\Base
 */
class PrecioCancha extends Model
{
	protected $table = 'precio_canchas';

	protected $casts = [
		'precio' => 'float',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'cancha_id' => 'int'
	];

	public function cancha()
	{
		return $this->belongsTo(Cancha::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Cancha;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HorarioCancha
 * 
 * @property int $id
 * @property int $hora_desde
 * @property int $hora_hasta
 * @property int $cancha_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cancha $cancha
 *
 * @package App\Models\Base
 */
class HorarioCancha extends Model
{
	protected $table = 'horario_canchas';

	protected $casts = [
		'hora_desde' => 'int',
		'hora_hasta' => 'int',
		'cancha_id' => 'int'
	];

	public function cancha()
	{
		return $this->belongsTo(Cancha::class);
	}
}

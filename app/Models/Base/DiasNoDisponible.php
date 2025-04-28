<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Cancha;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiasNoDisponible
 * 
 * @property int $id
 * @property Carbon $desde
 * @property Carbon|null $hasta
 * @property int $cancha_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cancha $cancha
 *
 * @package App\Models\Base
 */
class DiasNoDisponible extends Model
{
	protected $table = 'dias_no_disponibles';

	protected $casts = [
		'desde' => 'datetime',
		'hasta' => 'datetime',
		'cancha_id' => 'int'
	];

	public function cancha()
	{
		return $this->belongsTo(Cancha::class);
	}
}

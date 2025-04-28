<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Cancha;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoCancha
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Cancha[] $canchas
 *
 * @package App\Models\Base
 */
class EstadoCancha extends Model
{
	protected $table = 'estado_canchas';

	public function canchas()
	{
		return $this->hasMany(Cancha::class);
	}
}

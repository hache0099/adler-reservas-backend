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
 * Class CanchaBarrio
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
class CanchaBarrio extends Model
{
	protected $table = 'cancha_barrio';

	public function canchas()
	{
		return $this->hasMany(Cancha::class);
	}
}

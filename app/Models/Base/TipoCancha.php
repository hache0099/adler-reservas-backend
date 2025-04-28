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
 * Class TipoCancha
 * 
 * @property int $id
 * @property string|null $material
 * @property int|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Cancha[] $canchas
 *
 * @package App\Models\Base
 */
class TipoCancha extends Model
{
	protected $table = 'tipo_canchas';

	protected $casts = [
		'estado' => 'int'
	];

	public function canchas()
	{
		return $this->hasMany(Cancha::class);
	}
}

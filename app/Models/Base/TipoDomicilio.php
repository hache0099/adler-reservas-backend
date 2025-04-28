<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Domicilio;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoDomicilio
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property int|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Domicilio[] $domicilios
 *
 * @package App\Models\Base
 */
class TipoDomicilio extends Model
{
	protected $table = 'tipo_domicilios';

	protected $casts = [
		'estado' => 'int'
	];

	public function domicilios()
	{
		return $this->hasMany(Domicilio::class);
	}
}

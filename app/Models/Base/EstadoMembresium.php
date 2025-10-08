<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Socio;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoMembresium
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Socio[] $socios
 *
 * @package App\Models\Base
 */
class EstadoMembresium extends Model
{
	protected $table = 'estado_membresia';

	public function socios()
	{
		return $this->hasMany(Socio::class, 'estado_membresia_id');
	}
}

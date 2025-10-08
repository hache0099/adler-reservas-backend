<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\MembresiaMe;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrecioMembresium
 * 
 * @property int $id
 * @property float|null $precio
 * @property Carbon|null $fecha_desde
 * @property Carbon|null $fecha_hasta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|MembresiaMe[] $membresia_mes
 *
 * @package App\Models\Base
 */
class PrecioMembresium extends Model
{
	protected $table = 'precio_membresia';

	protected $casts = [
		'precio' => 'float',
		'fecha_desde' => 'datetime',
		'fecha_hasta' => 'datetime'
	];

	public function membresia_mes()
	{
		return $this->hasMany(MembresiaMe::class, 'precio_membresia_id');
	}
}

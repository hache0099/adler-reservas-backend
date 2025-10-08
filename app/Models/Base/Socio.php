<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\EstadoMembresium;
use App\Models\MembresiaMe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Socio
 * 
 * @property int $id
 * @property Carbon|null $fecha_alta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $estado_membresia_id
 * @property int $users_id
 * 
 * @property EstadoMembresium $estado_membresium
 * @property User $user
 * @property Collection|MembresiaMe[] $membresia_mes
 *
 * @package App\Models\Base
 */
class Socio extends Model
{
	protected $table = 'socio';

	protected $casts = [
		'fecha_alta' => 'datetime',
		'estado_membresia_id' => 'int',
		'users_id' => 'int'
	];

	public function estado_membresium()
	{
		return $this->belongsTo(EstadoMembresium::class, 'estado_membresia_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function membresia_mes()
	{
		return $this->hasMany(MembresiaMe::class);
	}
}

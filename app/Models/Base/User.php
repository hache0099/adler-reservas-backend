<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Perfile;
use App\Models\Persona;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $persona_id
 * @property int $perfil_id
 * 
 * @property Perfile $perfile
 * @property Persona $persona
 * @property Collection|Reserva[] $reservas
 *
 * @package App\Models\Base
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'persona_id' => 'int',
		'perfil_id' => 'int'
	];

	public function perfile()
	{
		return $this->belongsTo(Perfile::class, 'perfil_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function reservas()
	{
		return $this->hasMany(Reserva::class);
	}
}

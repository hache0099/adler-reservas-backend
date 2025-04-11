<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Perfile
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|PerfilModulo[] $perfil_modulos
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Perfile extends Model
{
	protected $table = 'perfiles';

	protected $fillable = [
		'descripcion'
	];

	public function perfil_modulos()
	{
		return $this->hasMany(PerfilModulo::class, 'perfil_id');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'perfil_id');
	}
}

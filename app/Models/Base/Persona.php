<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Domicilio;
use App\Models\PersonaContacto;
use App\Models\PersonaDocumento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $id
 * @property string|null $nombre
 * @property string|null $apellido
 * @property Carbon|null $fecha_nacimiento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Domicilio[] $domicilios
 * @property Collection|PersonaContacto[] $persona_contactos
 * @property Collection|PersonaDocumento[] $persona_documentos
 * @property Collection|User[] $users
 *
 * @package App\Models\Base
 */
class Persona extends Model
{
	protected $table = 'personas';

	protected $casts = [
		'fecha_nacimiento' => 'datetime'
	];

	public function domicilios()
	{
		return $this->hasMany(Domicilio::class);
	}

	public function persona_contactos()
	{
		return $this->hasMany(PersonaContacto::class);
	}

	public function persona_documentos()
	{
		return $this->hasMany(PersonaDocumento::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PerfilModulo
 * 
 * @property int $id
 * @property int $perfil_id
 * @property int $modulo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Modulo $modulo
 * @property Perfile $perfile
 *
 * @package App\Models
 */
class PerfilModulo extends Model
{
	protected $table = 'perfil_modulos';

	protected $casts = [
		'perfil_id' => 'int',
		'modulo_id' => 'int'
	];

	protected $fillable = [
		'perfil_id',
		'modulo_id'
	];

	public function modulo()
	{
		return $this->belongsTo(Modulo::class);
	}

	public function perfile()
	{
		return $this->belongsTo(Perfile::class, 'perfil_id');
	}
}

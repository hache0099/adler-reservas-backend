<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoDocumento
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property int|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|PersonaDocumento[] $persona_documentos
 *
 * @package App\Models
 */
class TipoDocumento extends Model
{
	protected $table = 'tipo_documentos';

	protected $casts = [
		'estado' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'estado'
	];

	public function persona_documentos()
	{
		return $this->hasOne(PersonaDocumento::class);
	}
}

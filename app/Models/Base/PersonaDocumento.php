<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Persona;
use App\Models\TipoDocumento;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaDocumento
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property int $persona_id
 * @property int $tipo_documento_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Persona $persona
 * @property TipoDocumento $tipo_documento
 *
 * @package App\Models\Base
 */
class PersonaDocumento extends Model
{
	protected $table = 'persona_documentos';

	protected $casts = [
		'persona_id' => 'int',
		'tipo_documento_id' => 'int'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function tipo_documento()
	{
		return $this->belongsTo(TipoDocumento::class);
	}
}

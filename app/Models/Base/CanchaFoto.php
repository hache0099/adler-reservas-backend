<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Cancha;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CanchaFoto
 * 
 * @property int $id
 * @property string|null $ruta
 * @property int|null $principal
 * @property int $cancha_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cancha $cancha
 *
 * @package App\Models\Base
 */
class CanchaFoto extends Model
{
	protected $table = 'cancha_fotos';

	protected $casts = [
		'principal' => 'int',
		'cancha_id' => 'int'
	];

	public function cancha()
	{
		return $this->belongsTo(Cancha::class);
	}
}

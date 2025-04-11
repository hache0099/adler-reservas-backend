<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class User
 * 
 * @property int $id
 * @property string $name
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
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;
	
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'persona_id' => 'int',
		'perfil_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'persona_id',
		'perfil_id'
	];

	public function perfile()
	{
		return $this->belongsTo(Perfile::class, 'perfil_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}

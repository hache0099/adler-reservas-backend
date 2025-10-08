<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\Base\User as BaseUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomResetPasswordNotification;
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
class User extends BaseUser implements MustVerifyEmail
{
	use HasApiTokens, HasFactory, Notifiable, \Illuminate\Auth\MustVerifyEmail;
	
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
		'estado',
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

	/**
		* Enviar la notificación de reseteo de contraseña.
		*
		* @param  string  $token
		* @return void
		*/
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new CustomResetPasswordNotification($token));
	}
	
	
	/**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }
	
}


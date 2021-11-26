<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable {
	use Notifiable;

	protected $table = 'user';
	protected $guard = 'admin';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/

	protected $fillable = [
		'name',
		'user_name',
		'email',
		'password',
		'author',
		'user_type_id',
	];

	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password', 'remember_token',
	];

	public function sendPasswordResetNotification($token) {
		$this->notify(new AdminResetPasswordNotification($token));
	}
}

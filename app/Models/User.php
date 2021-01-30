<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
	use SoftDeletes;
	
	protected $guarded = ['*'];
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
		'avatar', 
		'provider', 
		'provider_id', 
		'access_token',
        'password',
		'flag',
		'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
    public function tutor()
    {
        return $this->hasOne('App\Models\Tutor');
    }
	
//******************************************************************************
// User and verify_user tables relation
//******************************************************************************

	public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser', 'id_user');
    }
}

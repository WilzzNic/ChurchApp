<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const ROLE_L_KAJ = 'KAJ_leader';
    const ROLE_L_FA = 'FA_leader';
    const ROLE_L_KOM = 'KOM_leader';
    const ROLE_L_BAPTIS = 'baptis_leader';
    const ROLE_ADMIN = 'admin';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jemaat() {
        return $this->hasOne('App\Jemaat');
    }
}

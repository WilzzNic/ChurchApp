<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const ROLE_GUEST = 'guest';
    const ROLE_L_KAJ = 'KAJ_leader';
    const ROLE_L_FA = 'FA_leader';
    const ROLE_L_KOM = 'KOM_leader';
    const ROLE_L_BAPTIS = 'baptis_leader';
    const ROLE_ADMIN = 'admin';
    const ROLE_B_CON = 'basic_congregation';
    const ROLE_E_CON = 'expert_congregation';


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

    public static function laratablesCustomAction($model)
    {
        return view('widgets.admin.manageuser', compact('model'))->render();
    }

    public static function laratablesCustomAdmin($model)
    {
        return view('widgets.superadmin.admin.crud', compact('model'))->render();
    }

    public static function laratablesCustomCabang($model) {
        return $model->jemaat->cabangGereja->nama_gereja;
    }

    public static function laratablesModifyCollection($users)
    {
        return $users->map(function ($user) {
            if($user->role == User::ROLE_L_KAJ){
                $user->role = 'Pimpinan KAJ'; 
            }
            else if($user->role == User::ROLE_L_KOM) {
                $user->role = 'Pimpinan KOM';
            }
            else if($user->role == User::ROLE_L_BAPTIS) {
                $user->role = 'Pimpinan Baptis';
            }
            else {
                $user->role = 'Pimpinan Family Altar';
            }
            return $user;
        });
    }
}

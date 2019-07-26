<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class RolePimpinan implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $role = $value;

        $users = User::whereIn('role', [User::ROLE_L_KAJ, User::ROLE_L_KOM, User::ROLE_L_BAPTIS])
            ->whereHas('jemaat', function($query) {
                $query->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah) ;
            })->get();
            
        foreach($users as $user) {
            if($role == $user->role) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Jenis Pimpinan ini telah ada di Cabang Gereja Anda.';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\JadwalKOM;
use App\RequestKelasOrientasi;

class ModulKOM implements Rule
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
        $jadwal_id = $value;

        $jadwal = JadwalKOM::where('id', $jadwal_id)->first();

        $requests = RequestKelasOrientasi::where('jemaat_id', auth()->user()->jemaat->id)
                                        ->where('status', RequestKelasOrientasi::STATUS_COMPLETED)
                                        ->get();


        if(!$requests->isEmpty()) {
            for($i = 0; $i < count($requests); $i++) {
                $seris[$i] = $requests[$i]->jadwal->seri_kom;
            }

            $seris = array_unique($seris);

            for($i = 0; $i < count($seris); $i++) {
                if($jadwal->seri_kom == 200) {
                    if(!in_array(100, $seris)) {
                        return false;
                    }
                }
                else if($jadwal->seri_kom == 300) {
                    if(!in_array(200, $seris)) {
                        return false;
                    }
                }
                else if($jadwal->seri_kom == 400) {
                    if(!in_array(300, $seris)) {
                        return false;
                    }
                }
                else{
                    return true;
                }
            }
        }
        else {
            if($jadwal->seri_kom != 100) {
                return false;
            }
            else {
                return true;
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
        return 'Anda harus mengambil modul sebelumnya sebelum mengambil modul ini.';
    }
}

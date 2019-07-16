<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => ['required', 'min:3'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'tmpt_lhr' => ['required', 'string'],
            'tgl_lhr' => ['required', 'date'],
            'status_nikah' => ['required', 'string'],
            'profesi' => ['nullable', 'string'],
            'nama_ibu' => ['nullable', 'string'],
            'nama_ayah' => ['nullable', 'string'],
            'lokasi_ibadah' => ['nullable', 'string'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
        ];
    }
}

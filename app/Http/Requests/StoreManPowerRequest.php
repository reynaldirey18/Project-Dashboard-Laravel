<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManPowerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_telepon' => [
                'required',
                'regex:/^(?:\+62|0)[2-9][0-9]{7,12}$/'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'no_telepon.regex' => 'Nomor telepon harus diawali dengan +62 atau 0 dan terdiri dari 9 sampai 14 digit.',
        ];
    }
}

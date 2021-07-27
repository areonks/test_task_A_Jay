<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_name' => 'required|string|max:100',
            'address1' => 'required|string|',
            'address2' => 'required|string|',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'phone_no1' => 'required|string|max:20',
            'phone_no2' => 'max:20',
            'zip' => 'required|string|max:20',

            'user.first_name' => 'required|string|max:50',
            'user.last_name' => 'required|string|max:50',
            'user.email' => 'required|string|max:150',
            'user.password' => 'required|string|confirmed|max:256',
            'user.phone_no1' => 'required|string|max:100',

        ];
    }
}

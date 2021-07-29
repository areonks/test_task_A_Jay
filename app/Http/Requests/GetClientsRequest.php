<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetClientsRequest extends FormRequest
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
        $fieldList = [
            'id',
            'client_name',
            'address1',
            'address2',
            'city',
            'state',
            'country',
            'phone_no1',
            'phone_no2',
            'zip',
            'longitude',
            'latitude',
            'start_validity',
            'end_validity',
        ];

        return [
            'column' => [Rule::in($fieldList), 'nullable'],
            'query' => 'nullable|string|max:100',
            'sort_field' =>[Rule::in($fieldList), 'nullable'],
            'sort_order' => "in:desc,asc"
        ];
    }
}

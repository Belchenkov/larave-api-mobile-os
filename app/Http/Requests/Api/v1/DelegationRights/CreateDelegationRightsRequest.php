<?php

namespace App\Http\Requests\Api\v1\DelegationRights;

use Illuminate\Foundation\Http\FormRequest;

class CreateDelegationRightsRequest extends FormRequest
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
            'period_start' => 'required|date|date_format:Y-m-d H:i:s|before:period_end',
            'period_end' => 'required|date|date_format:Y-m-d H:i:s|after:period_start',
            'is_active' => 'required|int',
            'on_whom' => 'required|array'
        ];
    }
}

<?php

namespace App\Http\Requests\Api\v1\PassRequest;

use App\Structure\PassRequest\PassRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePassRequest extends FormRequest
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
            'visitors' => 'required|array',
            'phones' => 'required|array',
            'office_id' => [
                'required',
                'exists:sqlsrv_transition.transit_spr_offices,id_1c'
            ],
            'type' => [
                'required',
                Rule::in(PassRequest::$types)
            ],
            'comment' => 'max:1024',
            'date' => 'required|date'
        ];
    }
}

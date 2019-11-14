<?php

namespace App\Http\Requests\Api\v1\SupportRequest;

use Illuminate\Foundation\Http\FormRequest;

class GetSupportRequest extends FormRequest
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
            'type_request' => 'required|in:1,2,3'
        ];
    }
}

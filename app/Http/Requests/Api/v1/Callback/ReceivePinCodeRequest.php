<?php

namespace App\Http\Requests\Api\v1\Callback;

use Illuminate\Foundation\Http\FormRequest;

class ReceivePinCodeRequest extends FormRequest
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
            'id_phperson' => 'required|max:100',
            'tab_no' => 'required|max:100',
            'ad_login' => 'required|max:100',
            'pin_code' => 'required|size:4|unique:user_tokens',
            'created_at' => 'required'
        ];
    }
}

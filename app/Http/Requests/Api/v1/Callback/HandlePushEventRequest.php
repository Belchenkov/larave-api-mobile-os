<?php

namespace App\Http\Requests\Api\v1\Callback;

use App\Structure\Portal\PortalMessage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HandlePushEventRequest extends FormRequest
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
            '*.data' => 'sometimes',
            '*.type' => [
                'required',
                Rule::in(PortalMessage::$types)
            ],
            '*.title' => 'sometimes|max:255',
            '*.message' => 'required',
            '*.users' => 'required|array',
        ];
    }
}

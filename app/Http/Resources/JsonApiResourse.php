<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Http\Resources;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class JsonApiResourse extends JsonResource
{

    public function __construct($resource)
    {
        $this->additional([
            'result' => true
        ]);
        parent::__construct($resource);
    }

    public static function apiResponse($result = true, $data = null, $error = null) : JsonResponse
    {
        $response['result'] = $result;
        if (isset($data)) $response['data'] = $data;
        if (isset($error)) $response['error'] = $error;

        return response()->json($response);
    }

}

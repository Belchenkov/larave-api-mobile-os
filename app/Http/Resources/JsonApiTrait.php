<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;

trait JsonApiTrait
{

    public function apiSuccess($data = null) : JsonResponse
    {
        return JsonApiResourse::apiResponse(true, $data);
    }

    public function apiError($error = null) : JsonResponse
    {
        return JsonApiResourse::apiResponse(false, null, $error);
    }

}

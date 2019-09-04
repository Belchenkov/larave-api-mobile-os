<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Exceptions\Api;


use App\Http\Resources\JsonApiResourse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends HttpException
{

    public function getResponse($message = null)
    {
        return JsonApiResourse::apiResponse(false, null, $message ? $message : $this->getMessage())
            ->setStatusCode($this->getStatusCode());
    }
}

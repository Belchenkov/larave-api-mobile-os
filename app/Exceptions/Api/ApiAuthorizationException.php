<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Exceptions\Api;


class ApiAuthorizationException extends ApiException
{
    public function __construct()
    {
        parent::__construct(401, 'Unauthorized.', null, [], 0);
    }
}

<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Exceptions\Api;


class ApiGuestException extends ApiException
{
    public function __construct()
    {
        parent::__construct(403, 'Permission denied: guest only.', null, [], 0);
    }
}

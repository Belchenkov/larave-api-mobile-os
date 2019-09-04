<?php
/**
 * Created by black40x@yandex.ru
 * Date: 31/01/2019
 */

namespace App\Exceptions\Api;

class ApiNotFoundException extends ApiException
{

    public function __construct()
    {
        parent::__construct(404, 'Api Entry Point not found', null, [], 0);
    }

}

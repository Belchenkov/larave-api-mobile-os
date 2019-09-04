<?php
/**
 * Created by black40x@yandex.ru
 * Date: 31/01/2019
 */

namespace App\Exceptions\Api;

class ApiValidationException extends ApiException
{

    private $errors = null;

    public function __construct($errors = null)
    {
        $this->errors = $errors;
        parent::__construct(422, 'Validation Exception', null, [], 0);
    }

    public function getResponse($message = null)
    {
        return parent::getResponse($this->errors);
    }
}

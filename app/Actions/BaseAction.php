<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions;


use App\Http\Resources\JsonApiTrait;

class BaseAction
{
    use JsonApiTrait;

    private $actionResult = null;

    public function setActionResult($actionResult): void
    {
        $this->actionResult = $actionResult;
    }

    public function getActionResult()
    {
        return $this->actionResult;
    }
}

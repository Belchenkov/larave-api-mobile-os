<?php
/**
 * Created by black40x@yandex.ru
 * Date: 17/10/2019
 */

namespace App\Http\Resources\Api\v1;


use App\Http\Resources\JsonApiResourse;

class Offices extends JsonApiResourse
{

    public function toArray($request)
    {
        return [
            'id' => $this->id_1c,
            'code' => $this->Code1C,
            'name' => $this->Name,
        ];
    }

}

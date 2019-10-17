<?php
/**
 * Created by black40x@yandex.ru
 * Date: 17/10/2019
 */

namespace App\Http\Resources\Api\v1;


use App\Http\Resources\JsonApiResourse;

class File extends JsonApiResourse
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ext' => $this->ext,
            'name' => $this->name,
            'path' => url($this->path),
            'thumb' => url($this->thumb),
            'size' => $this->size,
            'type' => $this->type,
        ];
    }

}

<?php
/**
 * Created by black40x@yandex.ru
 * Date: 17/10/2019
 */

namespace App\Http\Resources\Api\v1;


use App\Http\Resources\JsonApiResourse;

class News extends JsonApiResourse
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'publish' => $this->publish,
            'created_at' => $this->created_at->format('Y.m.d H:i:s'),
            'updated_at' => $this->updated_at->format('Y.m.d H:i:s'),
            'images' => File::collection($this->images)
        ];
    }

}

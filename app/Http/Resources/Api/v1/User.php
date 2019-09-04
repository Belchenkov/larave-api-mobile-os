<?php

namespace App\Http\Resources\Api\v1;

use App\Http\Resources\JsonApiResourse;

class User extends JsonApiResourse
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ad_login' => $this->ad_login,
            'tab_no' => $this->tab_no,
            'id_person' => $this->id_person,
            'created_at' => $this->created_at->timestamp
        ];
    }
}

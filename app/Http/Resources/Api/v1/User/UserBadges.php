<?php

namespace App\Http\Resources\Api\v1\User;

use App\Http\Resources\JsonApiResourse;

/**
 * Class Profile
 * @package App\Http\Resources\Api\v1\Profile
 *  Get Profile Info
 */
class UserBadges extends JsonApiResourse
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
            'approval' => $this['approval'],
            'messages' => $this['messages'],
            'tasks' => $this['tasks'],
        ];
    }


}


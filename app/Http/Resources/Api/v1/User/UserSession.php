<?php

namespace App\Http\Resources\Api\v1\User;

use App\Http\Resources\JsonApiResourse;

/**
 * Class Profile
 * @package App\Http\Resources\Api\v1\Profile
 *  Get Profile Info
 */
class UserSession extends JsonApiResourse
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
            'current' => $this->current,
            'user_agent' => $this->user_agent,
            'ip_address' => $this->ip_address,
            'access_expire_at' => $this->access_expire_at,
            'refresh_expire_at' => $this->refresh_expire_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }


}


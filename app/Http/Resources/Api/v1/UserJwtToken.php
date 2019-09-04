<?php

namespace App\Http\Resources\Api\v1;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserJwtToken extends JsonResource
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
            'access_token' => $this->access_token,
            'refresh_token' => $this->refresh_token,
            'access_token_expire_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->access_expire_at)->timestamp,
            'refresh_token_expire_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->refresh_expire_at)->timestamp,
        ];
    }
}

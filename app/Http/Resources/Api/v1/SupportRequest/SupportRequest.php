<?php

namespace App\Http\Resources\Api\v1\SupportRequest;

use App\Http\Resources\JsonApiResourse;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SupportRequest extends JsonApiResourse
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
            'title' => Str::limit($this->comment, 20),
            'user_id' => $this->user_id,
            'type_request' => $this->type_request,
            'comment' => Str::limit($this->comment, 100),
            'from' => $this->from,
            'to' => $this->to,
            'is_send' => !!$this->is_send ? true : false,
            'created_at' => Carbon::parse($this->created_at)
        ];
    }
}

<?php

namespace App\Http\Resources\Api\v1;

use App\Http\Resources\JsonApiResourse;
use Carbon\Carbon;

class Tableau extends JsonApiResourse
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
            'title' => $this->title,
            'tableau_url' => $this->tableau_url,
            'users' => $this->relationLoaded('users') ? $this->users->map(function ($item) {
                return $item->id_phperson;
            }) : null,
            'created_at' => Carbon::parse($this->created_at),
            'updated_at' => Carbon::parse($this->updated_at)
        ];
    }
}

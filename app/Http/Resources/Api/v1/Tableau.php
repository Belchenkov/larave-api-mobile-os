<?php

namespace App\Http\Resources\Api\v1;

use App\Http\Resources\JsonApiResourse;

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
            'created_at' => $this->created_at->format('Y.m.d H:i:s'),
            'updated_at' => $this->updated_at->format('Y.m.d H:i:s'),
        ];
    }
}

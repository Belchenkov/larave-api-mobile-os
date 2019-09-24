<?php

namespace App\Http\Resources\Api\v1\Statistic;

use App\Http\Resources\JsonApiResourse;

class UserVisits extends JsonApiResourse
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
            'schedule' => [
                'time_in' => $this->get('schedule')->get('time')->get('date_in')->format('H:i'),
                'time_out' => $this->get('schedule')->get('time')->get('date_out')->format('H:i'),
            ],
            'days' => UserVisitDay::collection($this->get('days')),
            'previous' => $this->get('previous'),
        ];
    }
}

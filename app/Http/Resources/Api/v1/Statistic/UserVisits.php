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
            'data' => UserVisitDay::collection($this->get('days')),
            'meta' => [
                'schedule' => [
                    'time_in' => $this->get('schedule')->get('time')->get('date_in') ?
                        $this->get('schedule')->get('time')->get('date_in')->format('H:i') : null,
                    'time_out' => $this->get('schedule')->get('time')->get('date_out') ?
                        $this->get('schedule')->get('time')->get('date_out')->format('H:i') : null,
                ],
                'previous' => $this->get('previous'),
            ],
            'links' => [
                'first' => url()->current(),
                'next' => url()->current() . '?previous=' . $this->get('previous')
            ]
        ];
    }
}

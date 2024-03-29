<?php

namespace App\Http\Resources\Api\v1\Statistic;

use Illuminate\Http\Resources\Json\JsonResource;

class UserVisitDay extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->get('enter_time') || $this->get('exit_time')) {
            return [
                'enter_time' => $this->get('enter_time') ? $this->get('enter_time')->format('H:i') : null,
                'exit_time' => $this->get('exit_time') ? $this->get('exit_time')->format('H:i') : null,
                'work_time' => $this->get('work_time') ? $this->get('work_time')->format('H:i') : null,
                'idle_time' => $this->get('idle_time') ? $this->get('idle_time')->format('H:i') : null,
                'territory_time' => $this->get('territory_time') ? $this->get('territory_time')->format('H:i') : null,
                'is_late' => $this->get('is_late'),
                'is_earlier' => $this->get('is_earlier'),
                'day_of_week' => $this->get('day_of_week'),
            ];
        }

        if ($this->get('holiday')) {
            return [
                'holiday' => $this->get('holiday'),
                'doc_num' => $this->get('doc_num'),
                'status' => $this->get('status'),
                'day_of_week' => $this->get('day_of_week'),
            ];
        }

        return [
            'empty' => $this->get('empty'),
            'day_of_week' => $this->get('day_of_week'),
        ];

    }
}

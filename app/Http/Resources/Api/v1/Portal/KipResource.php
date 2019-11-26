<?php

namespace App\Http\Resources\Api\v1\Portal;

use App\Structure\User\UserAvatar;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class KipResource extends JsonResource
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
            'id' => $this['id'],
            'number' => $this['number'],
            'theme' => $this['theme'],
            'note' => $this['note'],
            'priority' => $this['priority'],
            'date_start' => $this['date_start'] ? Carbon::parse($this['date_start']) : null,
            'date_end' => $this['date_end'] ? Carbon::parse($this['date_end']) : null,
            'planned_date' => $this['planned_date'] ? Carbon::parse($this['planned_date']) : null,
            'fact_date' => $this['fact_date'] ? Carbon::parse($this['fact_date']) : null,
            'projectd' => $this['projectd'] ?
                [
                    'project_id' => $this['projectd']['project_id'],
                    'nm' => $this['projectd']['nm'],
                    'id_1c' => $this['projectd']['id_1c'],
                    'id_1c_parent' => $this['projectd']['id_1c_parent'],
                ] : null,
            'delegated' => $this['delegated'],
            'initiator_user' => $this['initiator_user'] ?
                [
                    'user_id' => $this['initiator_user']['user_id'],
                    'tab_no' => $this['initiator_user']['tab_no'],
                    'id_phperson' => $this['initiator_user']['id_phperson'],
                    'full_name' => $this['initiator_user']['last_name'] . ' ' .
                                   $this['initiator_user']['first_name'] . ' ' .
                                   $this['initiator_user']['middle_name'],
                    'avatar' => UserAvatar::fromFaker(
                        $this['initiator_user']['last_name'],
                        $this['initiator_user']['first_name'],
                        $this['initiator_user']['middle_name'],
                        $this['initiator_user']['tab_no'],
                        $this['initiator_user']['id_phperson'],
                    )->toArray(),
                ] : null,
            'executor_user' => $this['executor_user'] ?
                [
                    'user_id' => $this['executor_user']['user_id'],
                    'tab_no' => $this['executor_user']['tab_no'],
                    'id_phperson' => $this['executor_user']['id_phperson'],
                    'full_name' => $this['executor_user']['last_name'] . ' ' .
                        $this['executor_user']['first_name'] . ' ' .
                        $this['executor_user']['middle_name'],
                    'avatar' => UserAvatar::fromFaker(
                        $this['executor_user']['last_name'],
                        $this['executor_user']['first_name'],
                        $this['executor_user']['middle_name'],
                        $this['executor_user']['tab_no'],
                        $this['executor_user']['id_phperson'],
                    )->toArray(),
                ] : null,
            'is_complete' => $this['is_complete'],
            'is_overdue' => $this['is_overdue'],
            'is_archive' => $this['is_archive'],
            'files' => $this['files'],
            'comments' => collect($this['comments'])->map(function ($item) {
                $item['user'] = [
                    'user_id' => $item['user_id'],
                    'tab_no' => $item['tab_no'],
                    'id_phperson' => $item['id_phperson'],
                    'full_name' => $item['last_name'] . ' ' .
                        $item['first_name'] . ' ' .
                        $item['middle_name'],
                    'avatar' => UserAvatar::fromFaker(
                        $item['last_name'],
                        $item['first_name'],
                        $item['middle_name'],
                        $item['tab_no'],
                        $item['id_phperson'],
                    )->toArray(),
                ];

                return $item;
            }),
        ];
    }
}

<?php

/**
 * Transit DB itservice->transit_1c_schedule_employee
 * Desc: привязка сотрудников к графикам
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\TransitionModel;

class Transit1cScheduleEmployee extends TransitionModel
{
    protected $table = 'transit_1c_schedule_employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tab_no',
        'schedule_name',
        'date_in',
        'date_out',
        'dt',
        'base'
    ];
}

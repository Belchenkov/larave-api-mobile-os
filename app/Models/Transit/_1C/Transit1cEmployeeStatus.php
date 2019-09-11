<?php
/**
 * Transit DB itservice->transit_1c_employee_status
 * Desc: Состояний рабочего графика
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\TransitionModel;

class Transit1cEmployeeStatus extends TransitionModel
{
    protected $table = 'transit_1c_employee_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tab_no',
        'date_start',
        'date_end',
        'doc_tp',
        'doc_num',
        'status',
        'doc_dt',
        'dt',
        'base',
        'Guid1C',
        'number_order'
    ];
}

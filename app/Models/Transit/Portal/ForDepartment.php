<?php
/**
 * Transit DB itservice->for_department
 * Desc: Выгрузка подразделений с портала
 */
namespace App\Models\Transit\Portal;

use App\Models\Transit\TransitionModel;

class ForDepartment extends TransitionModel
{
    protected $table = 'for_department';

    protected $guarded = [
        'id',
        'external_id',
        'parent_id',
        'parent_external_id',
        'name',
        'manager_id',
        'manager_external_id',
        'directorate',
        'description',
        'enabled',
        'dt_update'
    ];

}

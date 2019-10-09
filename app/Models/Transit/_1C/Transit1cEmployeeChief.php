<?php

/**
 * Transit DB itservice->transit_1c_employee_chief
 * Desc: функциональные руководители
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\CoreUserData;
use App\Models\Transit\TransitionModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transit1cEmployeeChief extends TransitionModel
{
    protected $table = 'transit_1c_employee_chief';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tab_no_employee',
        'base',
        'dt',
        'tab_no_chief'
    ];

}

<?php

/**
 * Transit DB itservice->transit_1c_department
 * Desc: Подразделения структуры предприятия
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\TransitionModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transit1cDepartment extends TransitionModel
{
    protected $table = 'transit_1c_department';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_1c',
        'id_1CParent',
        'id_chief',
        'isDelete',
        'Code1C',
        'Name',
        'Code1CParent',
        'NameParent',
        'Dt',
        'base',
        'Active',
        'chief_dt',
        'order_1c',
        'tab_no_chief',
        'comment',
    ];

    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'tab_no', 'tab_no_chief');
    }
}

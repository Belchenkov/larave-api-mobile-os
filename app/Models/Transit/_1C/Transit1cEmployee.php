<?php
/**
 * Transit DB itservice->transit_1c_employee
 * Desc: Сотрудники
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit\_1C;

use App\Models\Transit\TransitionModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transit1cEmployee extends TransitionModel
{
    protected $table = 'transit_1c_employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tab_no',
        'base',
        'dt',
        'main_place',
        'out_date',
        'in_date',
        'position',
        'Department_code',
        'Organisation_INN',
        'probation',
        'position_code',
        'department_guid',
        'position_guid',
        'id_phperson',
        'position_category',
        'schedule',
        'id_schedule',
        'id_1c',
        'isdelete',
        'NotUse',
        'UpdateNum'
    ];

    /**
     * Get PhPerson Info from transit_1c_PhPerson (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function phPerson() : HasOne
    {
        return $this->hasOne(Transit1cPhPerson::class, 'id', 'id_phperson');
    }

    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'tab_no', 'tab_no');
    }
}

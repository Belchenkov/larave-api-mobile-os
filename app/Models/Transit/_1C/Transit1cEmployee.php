<?php
/**
 * Transit DB itservice->transit_1c_employee
 * Desc: Сотрудники
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit\_1C;

use App\Models\Transit\Portal\ForUser;
use App\Models\Transit\TransitionModel;
use App\Services\User\UserInterface;
use App\Services\User\UserTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $hidden = ['UpdateNum'];

    /**
     * Get User Info from for_users (Transit DB)
     * @return BelongsTo
     */
    public function forUser() : BelongsTo
    {
        return $this->belongsTo(ForUser::class, 'id_1c', 'id_phperson');
    }
}

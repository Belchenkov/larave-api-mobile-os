<?php
/**
 * Transit DB itservice->transit_1c_employee
 * Desc: Сотрудники
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit\_1C;

use App\Models\Transit\CoreUserData;
use App\Models\Transit\Portal\ForUser;
use App\Models\Transit\TransitionModel;
use App\Models\Transit\TransitSkudEvent;
use App\Models\Transit\TransitSprDepartmentorganisation;
use App\Models\Transit\TransitSprOffice;
use App\Models\User;
use App\Services\User\UserInterface;
use App\Services\User\UserTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

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

    public function forUser() : BelongsTo
    {
        return $this->belongsTo(ForUser::class, 'id_1c', 'id_phperson');
    }
}

<?php
/**
 * Transit DB itservice->transit_1c_employee
 * Desc: Сотрудники
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit\_1C;

use App\Models\Transit\CoreUserData;
use App\Models\Transit\TransitionModel;
use App\Models\Transit\TransitSkudEvent;
use App\Models\Transit\TransitSprDepartmentorganisation;
use App\Models\Transit\TransitSprOffice;
use App\Models\User;
use App\Services\User\UserInterface;
use App\Services\User\UserTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transit1cEmployee extends TransitionModel implements UserInterface
{
    use UserTrait;

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
     * Get User Data from ITS.Core_UserData Table (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function coreUserData() : HasOne
    {
        return $this->hasOne(CoreUserData::class, 'tab_no', 'tab_no');
    }

    /**
     * Get PhPerson Info from transit_1c_PhPerson (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function phPerson() : HasOne
    {
        return $this->hasOne(Transit1cPhPerson::class, 'id', 'id_phperson');
    }

    /**
     * Get Employee Chief Info from transit_1c_employee_chief (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function employeeChief() : HasOne
    {
        return $this->hasOne(Transit1cEmployeeChief::class, 'tab_no_employee', 'tab_no');
    }

    /**
     * Get Schedule Employee Info from transit_1c_schedule_employee (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function scheduleEmployee() : HasMany
    {
        return $this->hasMany(Transit1cScheduleEmployee::class, 'tab_no', 'tab_no');
    }

    /**
     * @return HasMany
     */
    public function employeeStatus() : HasMany
    {
        return $this->hasMany(Transit1cEmployeeStatus::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Skud Events from transit_skud_events (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function skudEvents() : HasMany
    {
        return $this->hasMany(TransitSkudEvent::class, 'ID_PhPerson', 'id_phperson');
    }

    /**
     * Get Spr Office from transit_spr_offices (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function sprOffice() : HasOne
    {
        return $this->hasOne(TransitSprOffice::class, 'id_Responsible', 'id_phperson');
    }

    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Department Organisation Data from transit_spr_departmentorganisation (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departmentOrganisation() : BelongsTo
    {
        return $this->belongsTo(TransitSprDepartmentorganisation::class, 'department_guid', 'Guid1c');
    }

    public function getTabNo()
    {
        return $this->tab_no;
    }

    public function getPhPerson()
    {
        return $this->id_phperson;
    }

    public function getAdLogin()
    {
        return $this->coreUserData ? $this->coreUserData->SamAccountName : null;
    }

    public function getFullName()
    {
        return $this->phPerson ? $this->phPerson->full_name : null;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getOffice()
    {
        return $this->coreUserData ? $this->coreUserData->Office : null;
    }

    public function getSchedule()
    {
        return $this->schedule;
    }
}

<?php
/**
 * Mobile DB
 * Desc: Callback от интранет портала при регистрации сотрудника
 */

namespace App\Models;

use App\Models\Transit\_1C\Transit1cDepartment;
use App\Models\Transit\_1C\Transit1cEmployee;
use App\Models\Transit\_1C\Transit1cEmployeeChief;
use App\Models\Transit\_1C\Transit1cEmployeeStatus;
use App\Models\Transit\_1C\Transit1cPhPerson;
use App\Models\Transit\_1C\Transit1cScheduleEmployee;
use App\Models\Transit\CoreUserData;
use App\Models\Transit\DoTask;
use App\Models\Transit\TransitSkudEvent;
use App\Models\Transit\TransitSprOffice;
use App\Services\Auth\JwtAuthenticatable;
use App\Services\MsSQL\AttributeHelperTrait;
use App\Services\MsSQL\MillesecondFixTrait;
use App\Services\User\UserInterface;
use App\Services\User\UserTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements UserInterface
{
    use Notifiable, JwtAuthenticatable, UserTrait, MillesecondFixTrait, AttributeHelperTrait;

    protected $table = 'users';
    protected $connection = 'sqlsrv';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ad_login', 'tab_no', 'id_person',
    ];

    /**
     * Get User Token(PIN)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function pinCode() : HasOne
    {
        return $this->hasOne(UserPinCode::class, 'user_id');
    }

    /**
     * Get User JWT Token
     * @return HasMany
     */
    public function jwtToken() : HasMany
    {
        return $this->hasMany(UserJwtToken::class, 'user_id');
    }

     /**
     * Get User Devices
     * @return HasMany
     */
    public function devices() : HasMany
    {
        return $this->hasMany(UserDevice::class, 'user_id');
    }

    /**
     * Get User Data from transit_1c_PhPerson Table (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function phPerson(): HasOne
    {
        return $this->hasOne(Transit1cPhPerson::class, 'id', 'id_person');
    }

    /**
     * Get User Data from ITS.Core_UserData Table (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function coreUserData() : HasOne
    {
        return $this->hasOne(CoreUserData::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Employee from transit_1c_employee (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function employee() : HasOne
    {
        return $this->hasOne(Transit1cEmployee::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Department Info from transit_1c_department (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function department() : HasOne
    {
        return $this->hasOne(Transit1cDepartment::class, 'tab_no_chief', 'tab_no');
    }

    /**
     * Get Employee Status Info from transit_1c_employee_status (Transit DB)
     * @return HasMany
     */
    public function employeeStatus() : HasMany
    {
        return $this->hasMany(Transit1cEmployeeStatus::class, 'tab_no', 'tab_no');
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
     * Get Statistic Visit Info from transit_1c_schedule_employee (Transit DB)
     * @return HasMany
     */
    public function scheduleEmployee() : HasMany
    {
        return $this->hasMany(Transit1cScheduleEmployee::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Offices Info from transit_spr_offices (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function sprOffice() : hasOne
    {
        return $this->hasOne(TransitSprOffice::class, 'id_Responsible', 'id_person');
    }

    /**
     * Get Skud Events Info from transit_skud_events (Transit DB)
     * @return HasMany
     */
    public function skudEvents() : hasMany
    {
        return $this->hasMany(TransitSkudEvent::class, 'ID_PhPerson', 'id_person');
    }

    /**
     * Get My Department where im a chief
     * @return HasMany
     */
    public function departmentChief()
    {
        return $this->hasMany(Transit1cDepartment::class, 'tab_no_chief', 'tab_no');
    }

    /**
     * Get Executors Tasks Data from do_tasks (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvalExecutorTasks() : HasMany
    {
        return $this->hasMany(DoTask::class, 'executor_employee', 'ad_login');
    }

    /**
     * Get Initiator Tasks Data from do_tasks (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvalInitiatorTasks() : HasMany
    {
        return $this->hasMany(DoTask::class, 'employee', 'ad_login');
    }

    public function getTabNo()
    {
        return $this->tab_no;
    }

    public function getPhPerson()
    {
        return $this->id_person;
    }

    public function getAdLogin()
    {
        return $this->ad_login;
    }

    public function getFullName()
    {
        return $this->getModelAttribute('phPerson.full_name');
    }

    public function getPosition()
    {
        return $this->getModelAttribute('employee.position');
    }

    public function getOffice()
    {
        return $this->getModelAttribute('coreUserData.Office');
    }

    public function getEmail()
    {
        return $this->getModelAttribute('coreUserData.Email');
    }

    public function getSchedule()
    {
        return $this->getModelAttribute('employee.schedule');
    }

    public function getDepartment()
    {
        return $this->getModelAttribute('employee.departmentOrganisation.Name');
    }

    public function getChiefName()
    {
        return $this->getModelAttribute('employeeChief.employeeChiefInfo.phPerson.full_name');
    }

    public function getWorkPhone()
    {
        return $this->getModelAttribute('phPerson.phone_internal');
    }

    public function getMobilePhone()
    {
        return $this->getModelAttribute('phPerson.phone_mobile');
    }

    public function getChiefMainName()
    {
        return $this->getModelAttribute('employee.realDepartment.department.chief.phPerson.full_name');
    }

    public function getRealDepartmentGuid()
    {
        return $this->getModelAttribute('employee.realDepartment.department.id_1c');
    }

    public function getExecutorTasks()
    {
        return $this->getModelAttribute('coreUserData.initiatorTasks');
    }

    public function getInitiatorTasks()
    {
        return $this->getModelAttribute('coreUserData.initiatorTasks');
    }
}

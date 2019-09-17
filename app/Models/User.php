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
use App\Models\Transit\TransitSkudEvent;
use App\Models\Transit\TransitSprOffice;
use App\Services\Auth\JwtAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Services\MsSQL\OriginalColumns;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, JwtAuthenticatable;

    protected $table = 'users';
    protected $dateFormat = 'Y-m-d H:i:s';

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
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function jwtToken() : HasOne
    {
        return $this->hasOne(UserJwtToken::class, 'user_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function employeeStatus() : HasOne
    {
        return $this->hasOne(Transit1cEmployeeStatus::class, 'tab_no', 'tab_no');
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
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
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
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function skudEvents() : hasMany
    {
        return $this->hasMany(TransitSkudEvent::class, 'ID_PhPerson', 'id_person');
    }
}

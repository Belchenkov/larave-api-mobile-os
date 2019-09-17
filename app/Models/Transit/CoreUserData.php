<?php

/**
 * Transit DB itservice->ITS.Core_UserData
 * Desc: Общая информация о пользователе
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit;

use App\Models\Transit\_1C\Transit1cDepartment;
use App\Models\Transit\_1C\Transit1cEmployee;
use App\Models\Transit\_1C\Transit1cEmployeeChief;
use App\Models\Transit\_1C\Transit1cPhPerson;
use App\Models\Transit\_1C\Transit1cScheduleEmployee;
use App\Models\User;
use App\Services\MsSQL\DottedQueryBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CoreUserData extends TransitionModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = \DB::raw('"ITS.Core_UserData"');
    }

    protected function newBaseQueryBuilder()
    {
        return new DottedQueryBuilder(
            $this->getConnection(), $this->getConnection()->getQueryGrammar(), $this->getConnection()->getPostProcessor()
        );
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dt',
        'SamAccountName',
        'telephoneNumber',
        'Email',
        'AccountlsDisabled',
        'AccountlsLockedOut',
        'id_phperson',
        'tab_no',
        'AccountType',
        'Title',
        'SID',
        'FirstName',
        'LastName',
        'DisplayName',
        'Mobile',
        'Domain',
        'SNILS',
        'ActiveDirectory'
    ];

    /**
     * Get PhPerson Data from transit_1c_PhPerson (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function phPerson() : HasOne
    {
        return $this->hasOne(Transit1cPhPerson::class, 'id_phperson');
    }

    /**
     * Get Employee Data from transit_1c_PhPerson (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee() : HasOne
    {
        return $this->hasOne(Transit1cEmployee::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Department Data from transit_1c_department (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department() : HasOne
    {
        return $this->hasOne(Transit1cDepartment::class, 'tab_no_chief', 'tab_no');
    }

    /**
     * Get Employee Data from transit_1c_department (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chief() : HasOne
    {
        return $this->hasOne(Transit1cEmployeeChief::class, 'tab_no_employee', 'tab_no');
    }

    /**
     * Get Schedule Employee Data from transit_1c_schedule_employee (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function scheduleEmployee() : HasOne
    {
        return $this->hasOne(Transit1cScheduleEmployee::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Skud Events Data from transit_1c_skud_events (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skudEvents() : HasMany
    {
        return $this->hasMany(TransitSkudEvent::class, 'ID_PhPerson', 'id_phperson');
    }

    /**
     * Get Office Data from transit_1c_skud_events (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
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
}

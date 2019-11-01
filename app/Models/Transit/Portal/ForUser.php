<?php
/**
 * Transit DB itservice->for_users
 * Desc: Выгрузка пользователей с портала
 */
namespace App\Models\Transit\Portal;

use App\Models\Transit\_1C\Transit1cEmployee;
use App\Models\Transit\_1C\Transit1cEmployeeStatus;
use App\Models\Transit\_1C\Transit1cPhPerson;
use App\Models\Transit\_1C\Transit1cScheduleEmployee;
use App\Models\Transit\DoSessionHeader;
use App\Models\Transit\DoSessionPass;
use App\Models\Transit\DoTask;
use App\Models\Transit\TransitionModel;
use App\Models\Transit\TransitSkudEvent;
use App\Models\User;
use App\Repositories\User\StatisticVisitRepository;
use App\Structure\User\UserAvatar;
use App\Structure\User\UserInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class ForUser extends TransitionModel implements UserInterface
{
    protected $table = 'for_users';

    protected $guarded = [
        'id',
        'external_id',
        'user_login',
        'user_ad_login',
        'email',
        'last_name',
        'first_name',
        'middle_name',
        'gender_id',
        'date_birth',
        'phone_work',
        'phone_mobile',
        'phone_mac',
        'show_flag',
        'territory',
        'work_schedule_id',
        'first_date_hire',
        'office_id',
        'id_phperson',
        'employee_external_id',
        'enabled',
        'dt_update',
        'manager_id',
        'manager_external_id',
        'manager2_id',
        'manager2_external_id',
        'department_id',
        'department_external_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_external_id', 'tab_no');
    }

    /**
     * Get Skud Events Info from transit_skud_events (Transit DB)
     * @return HasMany
     */
    public function skudEvents() : hasMany
    {
        return $this->hasMany(TransitSkudEvent::class, 'ID_PhPerson', 'id_phperson');
    }

    /**
     * @return BelongsTo
     */
    public function department() : BelongsTo
    {
        return $this->belongsTo(ForDepartment::class, 'department_external_id', 'external_id');
    }

    public function departmentChief() : HasMany
    {
        return $this->hasMany(ForDepartment::class, 'manager_external_id', 'employee_external_id');
    }

    public function employee() : HasOne
    {
        return $this->hasOne(Transit1cEmployee::class, 'tab_no', 'employee_external_id');
    }

    public function phPerson(): HasOne
    {
        return $this->hasOne(Transit1cPhPerson::class, 'id', 'id_phperson');
    }

    /**
     * Get Executors Tasks Data from do_tasks (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvalTasksExecutor() : HasMany
    {
        return $this->hasMany(DoTask::class, 'executor_employee', 'user_ad_login');
    }

    /**
     * Get Initiator Tasks Data from do_tasks (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvalTasksInitiator() : HasMany
    {
        return $this->hasMany(DoTask::class, 'employee', 'user_ad_login');
    }

    /**
     * @return HasMany
     */
    public function passHeaders() : HasMany
    {
        return $this->hasMany(DoSessionHeader::class, 'employee', 'user_ad_login');
    }

    /**
     * @return HasMany
     */
    public function employeeStatus() : HasMany
    {
        return $this->hasMany(Transit1cEmployeeStatus::class, 'tab_no', 'employee_external_id');
    }

    public function manager() : HasOne
    {
        return $this->hasOne(ForUser::class, 'id', 'manager_id');
    }

    public function managerSecond() : HasOne
    {
        return $this->hasOne(ForUser::class, 'id', 'manager2_id');
    }

    public function schedule() : HasMany
    {
        return $this->hasMany(Transit1cScheduleEmployee::class, 'tab_no', 'employee_external_id');
    }

    /*
     * User Interface methods
     */

    public function getUserFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getUserMiddleName(): ?string
    {
        return $this->middle_name;
    }

    public function getUserLastName(): ?string
    {
        return $this->last_name;
    }

    public function getUserFullName(): ?string
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }

    public function getUserPhoneWork(): ?string
    {
        return $this->phone_work;
    }

    public function getUserPhoneMobile(): ?string
    {
        return $this->phone_mobile;
    }

    public function getUserAvatar(): UserAvatar
    {
        return new UserAvatar($this);
    }

    public function getUserPosition(): ?string
    {
        return $this->position_name;
    }

    public function getUserUnit(): ?string
    {
        if ($this->department_name) {
            return trim($this->department_name);
        }

        return $this->getModelAttribute('department.name');
    }

    public function getUserOfficeTerritory(): ?string
    {
        return $this->territory;
    }

    public function getUserOfficeCabinet(): ?string
    {
        $office = $this->getUserOfficeTerritory();

        if (strpos($office, '/')) {
            $explode = explode('/', $office);

            return trim(isset($explode[2]) ? $explode[2] : '', ' ');
        } elseif (strpos($office, '\\')) {
            $explode = explode('\\', $office);

            return trim(isset($explode[2]) ? $explode[2] : '', ' ');
        }

        return null;
    }

    public function getUserOnline(): bool
    {
        if ($this->relationLoaded('skudEvents')) {
            if ($this->skudEvents->last() && $this->skudEvents->last()->direction == StatisticVisitRepository::VISIT_ENTER) return true;
        }

        return false;
    }

    public function getUserOnlineOfficeName(): ?string
    {
        return trim($this->skudEvents->last()->deviceRow->dev_name);
    }

    public function getUserSchedule() : ?string
    {
        return $this->getModelAttribute('employee.schedule');
    }

    public function getUserDepartmentId(): ?string
    {
        return $this->department_external_id;
    }

    public function getUserTabNo(): string
    {
        return $this->employee_external_id;
    }

    public function getUserAdLogin(): string
    {
        return $this->user_ad_login;
    }

    public function getUserPhPerson(): string
    {
        return $this->id_phperson;
    }

    public function getUserHolidays(): ?Collection
    {
        $holidays = null;

        if ($employeeStatus = $this->employeeStatus) {
            $holidays = (new StatisticVisitRepository)->checkHolidayUser($employeeStatus, Carbon::now(), true);
        }

        return $holidays;
    }

    public function getUserHolidaysCount(): ?int
    {
        if ($holidays = $this->getUserHolidays()) {
            $holidaysStart = Carbon::parse($holidays['date_start']);
            $holidaysEnd = Carbon::parse($holidays['date_end']);

            return $holidaysEnd->diffInDays($holidaysStart);
        }

        return 0;
    }

    public function getUserStatus() : string
    {
        return $this->getUserHolidays() ? $this->getUserHolidays()['status'] : 'Работает';
    }

    public function getUserIsManager() : bool
    {
        if ($this->departmentChief->count() > 0) {
            return true;
        }

        return false;
    }

    public function getUserManagerName() : ?string
    {
        return trim(
            $this->getModelAttribute('manager.last_name') . ' ' .
            $this->getModelAttribute('manager.first_name') . ' ' .
            $this->getModelAttribute('manager.middle_name')
        );
    }

    public function getUserManagerSecondName() : ?string
    {
        return trim(
            $this->getModelAttribute('managerSecond.last_name') . ' ' .
            $this->getModelAttribute('managerSecond.first_name') . ' ' .
            $this->getModelAttribute('managerSecond.middle_name')
        );
    }

    public function getUserOrganizationName(): ?string
    {
        return trim($this->organisation_name);
    }
}

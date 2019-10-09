<?php
/**
 * Created by black40x@yandex.ru
 * Date: 09/10/2019
 */

namespace App\Structure\User;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

interface UserInterface
{

    public function skudEvents() : hasMany;
    public function employeeStatus() : HasMany;
    public function schedule() : HasMany;
    public function approvalTasksExecutor() : HasMany;
    public function approvalTasksInitiator() : HasMany;

    public function getUserTabNo() : string;
    public function getUserPhPerson() : string;
    public function getUserDepartmentId() : ?string;

    public function getUserFirstName() : ?string;
    public function getUserMiddleName() : ?string;
    public function getUserLastName() : ?string;
    public function getUserAvatar() : UserAvatar;

    public function getUserPhoneWork() : ?string;
    public function getUserPhoneMobile() : ?string;

    public function getUserStatus() : string;
    public function getUserHolidays() : ?Collection;
    public function getUserHolidaysCount() : ?int;
    public function getUserUnit() : ?string;
    public function getUserPosition() : ?string;
    public function getUserOfficeTerritory() : ?string;
    public function getUserOfficeCabinet() : ?string;
    public function getUserSchedule() : ?string;
    public function getUserOnline() : bool;
    public function getUserIsManager() : bool;
    public function getUserManagerName() : ?string;
    public function getUserManagerSecondName() : ?string;

}

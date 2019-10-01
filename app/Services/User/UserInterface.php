<?php
/**
 * Created by black40x@yandex.ru
 * Date: 24/09/2019
 */

namespace App\Services\User;


interface UserInterface
{

    public function getTabNo();
    public function getPhPerson();
    public function getAdLogin();
    public function getEmail();
    public function getFullName();
    public function getPosition();
    public function getOffice();
    public function getSchedule();
    public function getDepartment();
    public function getChiefName();
    public function getChiefMainName();
    public function getWorkPhone();
    public function getMobilePhone();
    public function getRealDepartmentGuid();

    // Relations
    public function phPerson();
    public function skudEvents();
    public function scheduleEmployee();
    public function employeeChief();
    public function employeeStatus();
    public function departmentChief();
    public function getExecutorTasks();
    public function getInitiatorTasks();

}

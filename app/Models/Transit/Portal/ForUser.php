<?php
/**
 * Transit DB itservice->for_users
 * Desc: Выгрузка пользователей с портала
 */
namespace App\Models\Transit\Portal;

use App\Models\Transit\TransitionModel;

class ForUser extends TransitionModel
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
}

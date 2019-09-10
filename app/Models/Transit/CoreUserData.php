<?php

/**
 * Transit DB itservice->ITS.Core_UserData
 * Desc: Общая информация о пользователе
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit;

use App\Models\Transit\_1C\Transit1cPhPerson;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CoreUserData extends TransitionModel
{
    protected $table = 'ITS.Core_UserData';

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
     * Get Phisyc Person
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function phPerson() : HasOne
    {
        return $this->hasOne(Transit1cPhPerson::class, 'id_phperson');
    }

}
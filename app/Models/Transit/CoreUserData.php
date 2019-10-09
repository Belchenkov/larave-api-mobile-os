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
use App\Models\Transit\_1C\Transit1cEmployeeStatus;
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

}

<?php
/**
 * Transit DB itservice->do_tasks
 * Desc: Задачи
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DoTask extends  TransitionModel
{
    protected $table = 'do_tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_status',
        'is_active',
        'task_comment_execution'
    ];

    protected $guarded = [
        'name_task_1C',
        'id_process_source',
        'id_process_1C',
        'id_task_source',
        'id_task_source',
        'id_task_1C',
        'number',
        'Name_source',
        'Date',
        'employee',
        'employee_name',
        'plan_date_finish',
        'fact_date_finish',
        'type',
        'importance',
        'descriptions',
        'accept_date',
        'IsDelete',
        'type_descriptions',
        'id_process_1C_parent',
        'process_status',
        'executor_employee',
        'executor_name',
        'dt',
        'base',
        'dt_update_source',
        'type_doc',
        'Ref_1c'
    ];

    /**
     * Get Executor Data from ITS.Core_UserData (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function executor() : BelongsTo
    {
        return $this->belongsTo(CoreUserData::class, 'executor_employee','SamAccountName');
    }

    /**
     * Get Initiator Data from ITS.Core_UserData (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function initiator() : BelongsTo
    {
        return $this->belongsTo(CoreUserData::class, 'employee', 'SamAccountName');
    }
}

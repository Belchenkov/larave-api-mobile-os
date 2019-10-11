<?php
/**
 * Transit DB itservice->do_tasks
 * Desc: Задачи
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit;

use App\Models\SentPushHandle;
use App\Models\Transit\Portal\ForUser;
use App\Models\User;
use App\Services\MsSQL\OriginalColumns;
use App\Structure\ApprovalTask\ApprovalTaskActions;
use App\Structure\ApprovalTask\ApprovalTaskDocInfo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class DoTask extends  TransitionModel
{
    use OriginalColumns;

    private $originalColumns = ['id_task_1C'];
    protected $table = 'do_tasks';

    public $timestamps = false;
    protected $approvalTaskActions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_status',
        'is_active',
        'task_comment_execution',
        'fact_date_finish',
        'Name_source',
        'dt_update_source',
        'dt'
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

    public function __construct(array $attributes = [])
    {
        $this->approvalTaskActions = new ApprovalTaskActions();
        parent::__construct($attributes);
    }

    /**
     * Get Executor Data from for_users (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function executor() : BelongsTo
    {
        return $this->belongsTo(ForUser::class, 'executor_employee', 'user_ad_login');
    }

    /**
     * Get Initiator Data from for_users (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function initiator() : BelongsTo
    {
        return $this->belongsTo(ForUser::class, 'employee', 'user_ad_login');
    }

    public function user() : HasOne
    {
        return $this->hasOne(User::class, 'ad_login', 'executor_employee');
    }


    /**
     * Get Related Tasks from do_tasks (Transit DB)
     * @return HasMany
     */
    public function relatedTasks() : HasMany
    {
        return $this->hasMany(DoTask::class, 'id_process_1C_parent', 'id_process_1C_parent');
    }

    /**
     * Get Sended Pushes Tasks from do_task_handle (Mobile DB)
     * @return HasOne
     */
    public function handleTask() : HasOne
    {
        return $this->hasOne(SentPushHandle::class, 'event_id', 'id_task_1C');
    }

    public function setPrimaryKey()
    {
        $this->primaryKey = 'id_task_1C';
        return $this;
    }

    /**
     * Get Doc Info - Parse XML
     * @return Collection|null
     */
    public function getDocInfo() : ?Collection
    {
        return (new ApprovalTaskDocInfo($this->doc_info))->getDocInfo();
    }

    /**
     * Define Task Actions
     * @param string $key
     * @return array
     */
    public function getRelevantActions($key = 'actions') {
        return $this->approvalTaskActions->getRelevantActions(trim($this->type_descriptions), $key);
    }
}

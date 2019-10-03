<?php
/**
 * Transit DB itservice->do_tasks
 * Desc: Задачи
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class DoTask extends  TransitionModel
{
    protected $table = 'do_tasks';

    public $timestamps = false;
    protected $primaryKey = 'id_task_1C';
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

    const TASK_CAN_EDIT = 0;
    const TASK_ACCEPT = 1;
    const TASK_CANCEL = 2;
    const TASK_APPLY = 4;
    const TASK_APPLY_WITH_COMMENT = 3;

    private $statusStruct = [
        [
            'name' => 'Ознакомиться',
            'actions' => [self::TASK_APPLY, self::TASK_CANCEL]
        ],
        [
            'name' => 'Исполнить',
            'actions' => [self::TASK_APPLY]
        ],
        [
            'name' => 'Согласовать',
            'actions' => [self::TASK_APPLY]
        ],
        [
            'name' => 'Проверить исполнение',
            'actions' => [self::TASK_APPLY]
        ],
        [
            'name' => 'Утвердить',
            'actions' => [self::TASK_APPLY]
        ],
        [
            'name' => 'Рассмотреть вопрос',
            'actions' => [self::TASK_APPLY]
        ],
    ];

    /**
     * Get Executor Data from ITS.Core_UserData (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function executor() : BelongsTo
    {
        return $this->belongsTo(CoreUserData::class, 'executor_employee', 'SamAccountName');
    }

    /**
     * Get Initiator Data from ITS.Core_UserData (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function initiator() : BelongsTo
    {
        return $this->belongsTo(CoreUserData::class, 'employee', 'SamAccountName');
    }

    public function relatedTasks() : HasMany
    {
        return $this->hasMany(DoTask::class, 'id_process_1C_parent', 'id_process_1C_parent');
    }

    public function getDocInfo() : ?Collection
    {
        if (!$this->doc_info) return null;

        $xml = simplexml_load_string($this->doc_info);

        return collect([
            'theme' => (string) $xml['Тема'],
            'organization' => (string) $xml['Организация'],
            'partner' => (string) $xml['Контрагент'],
            'doc_no' => (string) $xml['Номер'],
            'date' => (string) $xml['Дата'],
            'cost' => (string) $xml['Сумма'],
            'executor' => (string) $xml['Ответственный'],
            'project' => (string) $xml['Проект'],
            'article' => (string) $xml['СтатьяДДС'],
            'files' => collect($xml->xpath('Файлы'))->map(function ($item) {
                $elem = $item->xpath('ДанныеФайла');
                if (!isset($elem[0])) return false;

                return collect([
                    'file_id' => (string) $elem[0]['Ссылка'],
                    'file_name' => (string) $elem[0]['Название']
                ]);
            })
        ]);
    }

    public function getRelevateActions() {
        foreach ($this->statusStruct as $status) {
            if (trim($this->type_descriptions) == $status['name']) {
                return $status['actions'];
            }
        }

        return [self::TASK_APPLY, self::TASK_CANCEL];
    }
}

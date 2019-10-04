<?php

namespace App\Models;

use App\Models\Transit\DoTask;
use App\Services\MsSQL\OriginalColumns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DoTaskHandle extends LocalDBModel
{
    use OriginalColumns;

    private $originalColumns = ['task_id'];
    protected $table = 'do_task_handle';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id'
    ];

    /**
     * Get Executors Tasks Data from do_tasks (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doTask() : BelongsTo
    {
        return $this->belongsTo(DoTask::class, 'task_id', 'id_task_1C');
    }
}

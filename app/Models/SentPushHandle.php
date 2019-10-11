<?php

namespace App\Models;

use App\Models\Transit\DoTask;
use App\Services\MsSQL\OriginalColumns;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SentPushHandle extends LocalDBModel
{
    use OriginalColumns;

    private $originalColumns = ['event_id'];
    protected $table = 'sent_pushes_handle';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id'
    ];

    /**
     * Get Executors Tasks Data from do_tasks (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doTask() : BelongsTo
    {
        return $this->belongsTo(DoTask::class, 'event_id', 'id_task_1C');
    }
}

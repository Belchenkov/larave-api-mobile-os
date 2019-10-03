<?php

namespace App\Models;

use App\Models\Transit\DoTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NewTaskPush extends Model
{
    protected $table = 'new_task_pushes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id', 'status'
    ];

    /**
     * Get Executors Tasks Data from do_tasks (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doTask() : HasOne
    {
        return $this->hasOne(DoTask::class, 'id_task_1C', 'task_id');
    }
}

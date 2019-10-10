<?php

namespace Tests\Feature\Api;

use App\Models\Transit\DoTask;
use Tests\TestCase;

class ApprovalTasksTest extends TestCase
{

    public function test_ApprovalTasks()
    {
        $this->be($this->factoryUser(), 'api');
        $response = $this->get('/api/v1/tasks/approval');
        $response->assertStatus(200);
    }

    public function test_ApprovalTasksArchive()
    {
        $this->be($this->factoryUser(), 'api');
        $response = $this->get('/api/v1/tasks/approval?archive=1');
        $response->assertStatus(200);
    }

    public function test_ApprovalTaskView()
    {
        if ($task = DoTask::where('executor_employee', self::user_login)->first()) {
            $this->be($this->factoryUser(), 'api');
            $response = $this->get('/api/v1/tasks/approval/' . $task->id_task_1C);
            $response->assertStatus(200);

            $response = $this->post('/api/v1/tasks/approval/' . $task->id_task_1C, [
                'status' => 0,
            ]);
            $response->assertStatus(422);
        }
    }



}

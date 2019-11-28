<?php

namespace Tests\Feature\Api;

use App\Repositories\PassRequestRepository;
use App\Structure\PassRequest\PassRequest;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PassRequestTest extends TestCase
{

    public function test_get_pass_requests()
    {
        $this->be($this->factoryUser(), 'api');

        $response = $this->get('/api/v1/request/pass');

        $response->assertStatus(200);
    }

    public function test_show_news()
    {
        $user = $this->factoryUser();

        $this->be($user, 'api');

        if ($passRequest = (new PassRequestRepository())->getUserPassRequests($user->portalUser)->first()) {
            $response = $this->get('/api/v1/request/pass/' . $passRequest['id']);
            $response->assertStatus(200);
        }
    }

    public function test_create_pass_request()
    {
        $user = $this->factoryUser();
        $this->be($user, 'api');

        $data = [
            'visitors' => [$user->portalUser->id_phperson],
            'phones' => ['+70000000000'],
            'office_id' => 'fe58db50-ea28-11e7-90f1-00155d504e00',
            'type' => PassRequest::$types[0],
            'comment' => 'Comment for test create pass request ' . Carbon::now()->format('Y-m-d H:i:s'),
            'date' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $response = $this->post('/api/v1/request/pass/create', $data);
        $response->assertStatus(200);
    }
}

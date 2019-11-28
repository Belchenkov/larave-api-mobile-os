<?php

namespace Tests\Feature\Api;

use App\Models\RequestSupport;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestSupportTest extends TestCase
{
    public function test_get_support_requests()
    {
        $this->be($this->factoryUser(), 'api');
        $type_request = RequestSupport::REQUEST_TYPE_SUPPORT;

        $response = $this->get('/api/v1/request/support?type_request=' . $type_request);

        $response->assertStatus(200);
    }

    public function test_send_support_request()
    {
        $user = $this->factoryUser();
        $this->be($user, 'api');

        $data = [
            'comment' => 'Comment for test send support request ' . Carbon::now()->format('Y-m-d H:i:s'),
            'type_request' => RequestSupport::REQUEST_TYPE_SUPPORT
        ];

        $response = $this->post('/api/v1/request/support', $data);
        $response->assertStatus(200);
    }

    public function test_show_support_request()
    {
        $user = $this->factoryUser();

        $this->be($user, 'api');

        if ($request_support = $user->requestSupport()->first()) {
            $response = $this->get('/api/v1/request/support/' . $request_support['id']);
            $response->assertStatus(200);
        }
    }

}

<?php

namespace Tests\Feature\Api;

use App\Services\Portal\IntranetPortalAPI;
use App\Services\Portal\Kip\KipStatuses;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KipPortalTest extends TestCase
{

    public function test_get_initiator_kip()
    {
        $this->be($this->factoryUser(), 'api');

        $response = $this->get('/api/v1/portal/kip/initiator');

        $response->assertStatus(200);
    }

    public function test_get_executor_kip()
    {
        $this->be($this->factoryUser(), 'api');

        $response = $this->get('/api/v1/portal/kip/executor');

        $response->assertStatus(200);
    }

    public function test_new_kip()
    {
        $user = $this->factoryUser();
        $this->be($user, 'api');

        $data = [
            'theme' => 'Theme for tests ' . Carbon::now()->format('Y-m-d H:i:s'),
            'note' => 'Note for tests',
            'date_start' => Carbon::now()->format('Y-m-d H:i:s'),
            'date_end' => Carbon::now()->addDays(1)->format('Y-m-d H:i:s'),
            'initiator_user' => $user->id_person,
            'executor_user' => $user->id_person,
            'assistants' => [$user->id_person],
            'observers' => [$user->id_person]
        ];
        $response = $this->post('/api/v1/portal/kip/create', $data);

        $response->assertStatus(200);

    }

    public function test_get_kip_id()
    {
        $user = $this->factoryUser();

        $this->be($user, 'api');

        if ($kip = (new IntranetPortalAPI())->getInitiatorKip($user->portalUser)->last()) {
            $response = $this->get('/api/v1/portal/kip/' . $kip['id']);
            $response->assertStatus(200);
        }
    }

    public function test_get_file()
        {
            $user = $this->factoryUser();
            $file_id = 1;

            $this->be($user, 'api');


            $response = $this->get('/api/v1/portal/kip/file/' . $file_id);
            $response->assertStatus(200);
        }

    public function test_comment_kip()
    {
        $user = $this->factoryUser();
        $this->be($user, 'api');

        $data = [
            'comment' => 'Comment for tests ' . Carbon::now()->format('Y-m-d H:i:s')
        ];

        if ($kip = (new IntranetPortalAPI())->getInitiatorKip($user->portalUser)->last()) {
            $response = $this->post('/api/v1/portal/kip/' . $kip['id'] . '/comment', $data);
            $response->assertStatus(200);
        }

    }

    public function test_update_kip_status()
    {
        $user = $this->factoryUser();
        $this->be($user, 'api');

        $data = [
            'status' => KipStatuses::STATUS_DEFER
        ];

        if ($kip = (new IntranetPortalAPI())->getInitiatorKip($user->portalUser)->last()) {
            $response = $this->post('/api/v1/portal/kip/' . $kip['id'] . '/update/status', $data);
            $response->assertStatus(200);
        }

    }
}

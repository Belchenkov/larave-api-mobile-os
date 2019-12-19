<?php

namespace Tests\Feature\Api;

use App\Repositories\DelegationRightsRepository;
use Carbon\Carbon;
use Tests\TestCase;

class DelegationRightsTest extends TestCase
{

    public function test_get_delegations()
    {
        $this->be($this->factoryUser(), 'api');
        $response = $this->get('/api/v1/delegations');
        $response->assertStatus(200);
    }

    public function test_create_delegation()
    {
        $user = $this->factoryUser();
        $this->be($user, 'api');

        $data = [
            'on_whom' => 'k.spiridonov',
            'period_start' =>  Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
            'period_end' => Carbon::now()->subDays(1)->format('Y-m-d H:i:s'),
            'is_active' => 0
        ];

        $response = $this->post('/api/v1/delegations', $data);
        $response->assertStatus(200);
    }

    public function test_get_delegationById()
    {
        $user = $this->factoryUser();
        $this->be($user, 'api');

        if ($delegation = (new DelegationRightsRepository())->getExecutors($user->portalUser)->first()) {
            $response = $this->get('/api/v1/delegations/' . $delegation['KeyRow']);
            $response->assertStatus(200);
        }
    }

    public function test_update_delegation()
    {
        $user = $this->factoryUser();
        $this->be($user, 'api');

        $data = [
            'is_active' => 1
        ];

        if ($delegation = (new DelegationRightsRepository())->getExecutors($user->portalUser)->first()) {
            $response = $this->post('/api/v1/delegations/' . $delegation['KeyRow'], $data);
            $response->assertStatus(200);
        }
    }

}

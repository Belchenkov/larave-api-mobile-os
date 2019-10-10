<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{

    public function test_UserProfile()
    {
        $this->be($this->factoryUser(), 'api');
        $response = $this->get('/api/v1/profile');
        $response->assertStatus(200);
    }

    public function test_UserProfileVisits()
    {
        $this->be($this->factoryUser(), 'api');
        $response = $this->get('/api/v1/statistic/visit');
        $response->assertStatus(200);
    }
}

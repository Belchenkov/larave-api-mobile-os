<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InformationTest extends TestCase
{
    public function test_get_information_offices()
    {
        $this->be($this->factoryUser(), 'api');

        $response = $this->get('/api/v1/information/offices');

        $response->assertStatus(200);
    }

    public function test_get_badges()
    {
        $this->be($this->factoryUser(), 'api');

        $response = $this->get('/api/v1/badges');

        $response->assertStatus(200);
    }
}

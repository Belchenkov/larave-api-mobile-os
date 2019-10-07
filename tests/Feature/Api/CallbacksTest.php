<?php

namespace Tests\Feature\Api;

use Carbon\Carbon;
use Tests\TestCase;

class CallbacksTest extends TestCase
{
    public function test_CallbackProtectHeader()
    {
        $response = $this->post('/api/v1/callback/pin/update', []);
        $response->assertStatus(401);
    }

}

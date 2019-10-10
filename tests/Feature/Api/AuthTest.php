<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UserJwtToken;
use App\Models\UserPinCode;
use Carbon\Carbon;
use Tests\TestCase;

class AuthTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Auth()
    {
        $response = $this->withHeader('x-callback-key', config('workflow.callback_key'))
            ->post('/api/v1/callback/pin/update', [
                'ad_login' => self::user_login,
                'tab_no' => self::user_tabno,
                'id_phperson' => self::user_phperson,
                'pin_code' => self::user_pincode,
                'created_at' => Carbon::now()->timestamp,
            ]);

        $response->assertStatus(200);

        $response = $this->post('/api/v1/auth/login', [
            'pin_code' => self::user_pincode,
            'email' => self::user_email
        ]);

        $response->assertStatus(201);

        // ToDo - clear tokens for this user!
        if ($user = User::where('ad_login', self::user_login)->first()) {
            $user->removeAllSession();
        }
    }

}

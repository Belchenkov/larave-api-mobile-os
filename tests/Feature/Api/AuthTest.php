<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class AuthTest extends TestCase
{
    const user_email = 's.chursin@gk-osnova.ru';
    const user_login = 's.chursin';
    const user_tabno = 'BR00000016';
    const user_phperson = '381004a1-d925-11e8-9126-00155d640b22';
    const user_pincode = '0000';

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
    }
}

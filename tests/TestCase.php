<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const user_email = 's.chursin@gk-osnova.ru';
    const user_login = 's.chursin';
    const user_tabno = 'BR00000016';
    const user_phperson = '381004a1-d925-11e8-9126-00155d640b22';
    const user_pincode = '0000';

    public function factoryUser() : User
    {
        return factory(User::class)->make([
            'id' => 1,
            'ad_login' => self::user_login,
            'tab_no' => self::user_tabno,
            'id_person' => self::user_phperson,
            'email' => self::user_email,
        ]);
    }

}

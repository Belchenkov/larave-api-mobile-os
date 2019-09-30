<?php

use App\Models\User;
use App\Notifications\Push\TestPush;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('push', function () {
    $u = User::find(1);
    $u->notify(new TestPush('Test Message'));
})->describe('Display an inspiring quote');

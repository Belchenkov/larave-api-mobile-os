<?php

use App\Jobs\HandleNewTask;
use App\Models\User;
use App\Notifications\Push\SendPush;
use App\Services\ApprovalTask\DocumentStructure;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Hash;

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

Artisan::command('make:admin {ad_login} {password}', function () {
    if ($user = User::where('ad_login', $this->argument('ad_login'))->first()) {
        $user->password = Hash::make($this->argument('password'));
        $user->is_admin = 1;
        $user->save();
        $this->info('Administrator created!');
    } else
        $this->error('User not found!');
})->describe('Make Admin user');

Artisan::command('push', function () {
    $u = User::find(1);
    $u->notify(new SendPush('', 'Hello every body. 🔥', 'Test Data'));
})->describe('Send test push message');

Artisan::command('jobs:init', function () {
    App\Jobs\ApprovalJobs\HandleNewTask::dispatch();
    App\Jobs\Schedule\HandleIsVisitUser::dispatch();
})->describe('Send push');

Artisan::command('jobs:clear', function () {
    DB::table('jobs')->delete();
})->describe('Clear jobs db table');

Artisan::command('jobs:test', function () {
    $t = \App\Models\Tableau::find(1);
    $t->notify(new \App\Notifications\Tableau\TableauNotification('Добален отчет'));
})->describe('Send push');

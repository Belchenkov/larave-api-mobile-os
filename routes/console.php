<?php

use App\Actions\ApprovalTask\NewTaskAction;
use App\Jobs\HandleNewTask;
use App\Models\Transit\DoTask;
use App\Models\User;
use App\Notifications\ApprovalTask\NewTaskNotification;
use App\Notifications\Push\SendPush;
use App\Repositories\ApprovalTaskRepository;
use App\Repositories\User\StatisticVisitRepository;
use App\Repositories\User\UserRepository;
use App\Services\ApprovalTask\DocumentStructure;
use Carbon\Carbon;
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
    $u->notify(new SendPush('New task', 'You have new document! Please visit app.', 'Test Data'));
})->describe('Send test push message');

Artisan::command('jobs:init', function () {
    App\Jobs\ApprovalJobs\HandleNewTask::dispatch();
    App\Jobs\Schedule\HandleIsLateUser::dispatch();
})->describe('Send push');

Artisan::command('jobs:clear', function () {
    DB::table('jobs')->delete();
})->describe('Clear jobs db table');


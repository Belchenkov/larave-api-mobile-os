<?php

namespace App\Jobs\HandlePush;

use App\Models\User;
use App\Notifications\Kip\HandlePushNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EventPushNotificateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $push;

    /**
     * Create a new job instance.
     *
     * @param $push
     */
    public function __construct($push)
    {
        $this->push = $push;
    }

    private function notifyUser($id_phperson)
    {
        if ($user = User::where('id_person', $id_phperson)->first()) {
            $user->notify(new HandlePushNotification($this->push));
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->push['users'] as $user) {
            $this->notifyUser($user);
        }
    }
}

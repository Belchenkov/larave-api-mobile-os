<?php

namespace App\Jobs\Kip;

use App\Models\User;
use App\Notifications\Kip\HandleKipNotification;
use App\Notifications\Kip\UpdateKipNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EventKipNotificateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $kip;

    /**
     * Create a new job instance.
     *
     * @param $kip
     * @param bool $new_kip
     */
    public function __construct($kip)
    {
        $this->kip = $kip;
    }

    private function notifyUser($id_phperson)
    {
        if ($user = User::where('id_person', $id_phperson)->first()) {
            $user->notify(new HandleKipNotification($this->kip));
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->kip['users'] as $user) {
            $this->notifyUser($user);
        }
    }
}

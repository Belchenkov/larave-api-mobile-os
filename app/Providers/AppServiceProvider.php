<?php

namespace App\Providers;

use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTasks;
use App\Models\RequestSupport;
use App\Notifications\Support\SupportRequestNotification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::after(function (JobProcessed $event) {
            $payload = $event->job->payload();

            if (SupportRequestNotification::class === $payload['displayName']) {
                $mail = unserialize($payload['data']['command'], '')->notification->mail;

                RequestSupport::find($mail->id)
                    ->update([
                        'is_send' => 1
                    ]);
            }
        });
    }
}

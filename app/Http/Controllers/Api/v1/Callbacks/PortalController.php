<?php

namespace App\Http\Controllers\Api\v1\Callbacks;

use App\Http\Requests\Api\v1\Callback\HandlePushEventRequest;
use App\Jobs\HandlePush\EventPushNotificateJob;
use App\Http\Controllers\Controller;

class PortalController extends Controller
{

    public function handlePushEvent(HandlePushEventRequest $request)
    {
        foreach ($request->all() as $item) {
            $this->dispatch(new EventPushNotificateJob($item));
        }

        return $this->apiSuccess();
    }

}

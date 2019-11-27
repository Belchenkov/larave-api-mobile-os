<?php

namespace App\Http\Controllers\Api\v1\Callbacks;

use App\Jobs\Kip\EventKipNotificateJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortalController extends Controller
{

    public function handleKipEvent(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'type' => 'required',
            'title' => 'required',
            'message' => 'required',
            'users' => 'required|array'
        ]);

        $this->dispatch(new EventKipNotificateJob($request->all([
            'id',
            'type',
            'title',
            'message',
            'users',
        ])));

        return $this->apiSuccess();
    }

}

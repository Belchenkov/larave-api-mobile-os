<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Mailing;
use App\Notifications\News\NewMailingNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MailingController extends Controller
{

    public function index(Request $request)
    {
        return $this->apiSuccess(
            Mailing::orderBy('created_at', 'DESC')->paginate(15)
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:200',
        ]);

        $mailing = Auth::user()->mailing()->create($request->all());

        // Send Push
        $mailing->notify(new NewMailingNotification());

        return $this->apiSuccess([
            'id' => $mailing->id
        ]);
    }

}

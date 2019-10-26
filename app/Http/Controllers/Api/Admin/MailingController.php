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
        $mailings = Mailing::orderBy('created_at', 'DESC')->paginate(15);
        $mailings->getCollection()->transform(function($item) {
            return [
                'id' => $item->id,
                'content' => $item->content,
                'created_at' => $item->created_at->format('Y.m.d H:i:s'),
            ];
        });

        return $this->apiSuccess(
            $mailings
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

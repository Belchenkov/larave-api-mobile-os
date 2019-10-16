<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Api\v1\User\UserCatalog;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminsController extends Controller
{

    public function index(Request $request)
    {
        return UserCatalog::collection(
            User::where('is_admin', 1)->with([
                'portalUser',
                'portalUser.skudEvents' => function ($query) {
                    UserRepository::getLatestSkudEvents($query);
                },
                'portalUser.department'
            ])->get()->map(function($item) {
                return $item->portalUser;
            })
        );
    }

}

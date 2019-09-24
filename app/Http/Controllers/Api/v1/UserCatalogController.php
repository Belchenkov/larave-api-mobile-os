<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\User\UserCatalog;
use App\Models\Transit\_1C\Transit1cEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCatalogController extends Controller
{

    public function index(Request $request)
    {
        // ToDo without paginate
        return UserCatalog::collection(
            Transit1cEmployee::with([
                'phPerson'
            ])
            ->limit(10)
            ->get()
        );
    }

}

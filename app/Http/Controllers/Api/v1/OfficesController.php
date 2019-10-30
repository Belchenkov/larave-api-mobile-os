<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\Offices;
use App\Models\Transit\TransitSprOffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class OfficesController extends Controller
{

    public function index(Request $request)
    {
        return Cache::remember('offices', config('cache.cache_time'), function () {
            return Offices::collection(TransitSprOffice::whereNull('id_1CParent')->get());
        });
    }

}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    public function index(Request $request)
    {
        return News::collection(News::where('publish', 1)->with('images')->simplePaginate(15));
    }


}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    public function index(Request $request)
    {
        return $this->apiSuccess(
            News::orderBy('created_at', 'DESC')->paginate(15)
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'publish' => 'boolean',
        ]);

        $news = News::create($request->all());

        return $this->apiSuccess([
            'id' => $news->id
        ]);
    }

    public function update(Request $request, News $news)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'publish' => 'in:0,1',
        ]);

        $news->update($request->all());

        return $this->apiSuccess([
            'id' => $news->id
        ]);
    }

    public function show(Request $request, News $news)
    {
        return $this->apiSuccess($news);
    }

    public function delete(Request $request, News $news)
    {
        $news->delete();
        return $this->apiSuccess();
    }

}

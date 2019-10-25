<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\File;
use App\Models\News;
use App\Notifications\News\NewNewsNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        if ($request->get('files')) {
            $news->images()->saveMany(File::whereIn('id', $request->get('files'))->get());
        }

        // Send Push
        $news->notify(new NewNewsNotification());

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

        if ($request->get('files')) {
            $news->images()->saveMany(File::whereIn('id', $request->get('files'))->get());
        }

        return $this->apiSuccess([
            'id' => $news->id
        ]);
    }

    public function show(Request $request, News $news)
    {
        return new \App\Http\Resources\Api\v1\News($news);
    }

    public function delete(Request $request, News $news)
    {
        $news->delete();
        return $this->apiSuccess();
    }

}

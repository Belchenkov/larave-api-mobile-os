<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Tableau;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableauController extends Controller
{
    public function index(Request $request)
    {
        return $this->apiSuccess(
            Tableau::orderBy('created_at', 'DESC')->paginate(15)
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'tableau_url' => 'required'
        ]);

        $tableau = Tableau::create($request->all(['title', 'tableau_url']));

        if (is_array($request->get('users'))) {
            foreach ($request->get('users') as $id_phperson)
                $tableau->users()->create(['id_phperson' => $id_phperson]);
        }

        // Send Push For users!!!
        //if ($request->get('publish'))
        //    $news->notify(new NewNewsNotification());

        return $this->apiSuccess([
            'id' => $tableau->id
        ]);
    }

    public function update(Request $request, Tableau $tableau)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'tableau_url' => 'required'
        ]);

        $tableau->update($request->all(['title', 'tableau_url']));

        $tableau->users()->delete();

        if (is_array($request->get('users'))) {
            foreach ($request->get('users') as $id_phperson)
                $tableau->users()->create(['id_phperson' => $id_phperson]);
        }

        return $this->apiSuccess([
            'id' => $tableau->id
        ]);
    }

    public function show(Request $request, Tableau $tableau)
    {
        $tableau->load('users');
        return new \App\Http\Resources\Api\v1\Tableau($tableau);
    }

    public function delete(Request $request, Tableau $tableau)
    {
        $tableau->delete();
        return $this->apiSuccess();
    }
}

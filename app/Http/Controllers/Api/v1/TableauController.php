<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\ApiException;
use App\Http\Resources\Api\v1\Tableau as TableauResource;
use App\Models\Tableau;
use App\Services\Tableau\TableauAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class TableauController extends Controller
{
    public function index(Request $request)
    {
        return TableauResource::collection(Auth()->user()->tableau);
    }

    public function show(Request $request, Tableau $tableau, TableauAPI $tableauApi)
    {
        if (!Auth()->user()->tableau()->where('id', $tableau->id)->first())
            throw new ApiException(401, 'Unauthorized for this report.');

        $tableau->setAttribute('tableau_url', $tableauApi->getUrlWithTicket($tableau->tableau_url));
        return new TableauResource($tableau);
    }
}

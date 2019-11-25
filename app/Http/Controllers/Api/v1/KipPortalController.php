<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\ApiException;
use App\Exceptions\Api\ApiNotFoundException;
use App\Http\Resources\Api\v1\Portal\KipResource;
use App\Services\Portal\IntranetPortalAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KipPortalController extends Controller
{

    public function getInitiatorKip(Request $request, IntranetPortalAPI $api)
    {
        $res = $api->getInitiatorKip(Auth::user()->portalUser);
        if (isset($res['error']) || !$res) $res = collect();
        return KipResource::collection($res);
    }

    public function getExecutorKip(Request $request, IntranetPortalAPI $api)
    {
        $res = $api->getExecutorKip(Auth::user()->portalUser);
        if (isset($res['error']) || !$res) $res = collect();
        return KipResource::collection($res);
    }

    public function getKip(Request $request, $kip_id, IntranetPortalAPI $api)
    {
        $res = $api->getKip(Auth::user()->portalUser, $kip_id);
        if (isset($res['error']) || !$res)
            throw new ApiException(422, $res['error']);

        return new KipResource($res);
    }

    public function getFile(Request $request, $file_id, IntranetPortalAPI $api)
    {
        $res = $api->getFile($file_id);
        if (implode('', $res->getHeader('Content-Type')) == 'application/json; charset=UTF-8' || !$res)
            throw new ApiException(404, 'File not found.');

        return response($res->getBody()->getContents(), 200, $res->getHeaders());
    }

}

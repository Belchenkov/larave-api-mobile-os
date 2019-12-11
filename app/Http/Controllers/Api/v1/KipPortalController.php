<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\ApiException;
use App\Http\Resources\Api\v1\Portal\KipResource;
use App\Services\Portal\IntranetPortalAPI;
use App\Services\Portal\Kip\KipStatuses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

    public function commentKip(Request $request, $kip_id, IntranetPortalAPI $api)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $res = $api->commentKip(Auth::user()->portalUser, $kip_id, $request->get('comment'));
        if (isset($res['error']) || !$res)
            throw new ApiException(422, $res['error']);

        return $this->apiSuccess();
    }

    public function updateKipStatus(Request $request, $kip_id, IntranetPortalAPI $api)
    {
        $this->validate($request, [
            'status' => [
                Rule::in([
                    KipStatuses::STATUS_WAITING_CONTROL,
                    KipStatuses::STATUS_IN_WORK,
                    KipStatuses::STATUS_DEFER,
                    KipStatuses::STATUS_COMPLETED
                ]),
                'required'
            ]
        ]);

        $res = $api->updateKipStatus(Auth::user()->portalUser, $kip_id, $request->get('status'));
        if (isset($res['error']) || !$res)
            throw new ApiException(422, $res['error']);

        return $this->apiSuccess();
    }

    public function newKip(Request $request, IntranetPortalAPI $api)
    {
        $this->validate($request, [
            'theme' => 'required',
            'note' => 'required',
            'date_start' => 'required|date|date_format:Y-m-d H:i:s|before:date_end',
            'date_end' => 'required|date|date_format:Y-m-d H:i:s|after:date_start',
            'initiator_user' => 'required',
            'executor_user' => 'required',
            'assistants' => 'sometimes|array',
            'observers' => 'sometimes|array',
        ]);

        $res = $api->createKip(Auth::user()->portalUser, $request->all());
        if (isset($res['error']) || !$res) {
            if (is_array($res['error'])) {
                throw new ApiException(422, implode(' ', $res['error']));
            } else
                throw new ApiException(422, $res['error']);
        }

        return $this->apiSuccess();
    }

    public function getFile(Request $request, $file_id, IntranetPortalAPI $api)
    {
        $res = $api->getFile($file_id);

        if (implode('', $res->getHeader('Content-Type')) == 'application/json; charset=UTF-8' || !$res)
            throw new ApiException(404, 'File not found.');

        return response($res->getBody()->getContents(), 200, $res->getHeaders());
    }

}

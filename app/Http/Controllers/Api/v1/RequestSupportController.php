<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\SupportRequest\RequestSupportAction;
use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\SupportRequest\GetSupportRequest;
use App\Http\Requests\Api\v1\SupportRequest\SupportRequest;
use App\Http\Resources\Api\v1\SupportRequest\SupportRequest as SupportRequestResource;
use App\Repositories\SupportRequestRepository;
use Illuminate\Support\Facades\Auth;

class RequestSupportController extends Controller
{
    /**
     * @param GetSupportRequest $request
     * @param SupportRequestRepository $supportRequestRepository
     * @return mixed
     */
    public function index(GetSupportRequest $request, SupportRequestRepository $supportRequestRepository)
    {
        return SupportRequestResource::collection($supportRequestRepository->getSupportRequests(
            Auth::user(),
            $request->input('type_request')
        )->simplePaginate(15));
    }

    /**
     * @param $request_id
     * @param SupportRequestRepository $supportRequestRepository
     * @return SupportRequestResource
     */
    public function show($request_id, SupportRequestRepository $supportRequestRepository)
    {
        if (!$request_support = $supportRequestRepository->getSupportRequest(Auth::user(), $request_id)) {
            throw new ApiException(404, 'Request support not found.');
        }

        return new SupportRequestResource($request_support);
    }

    /**
     * @param SupportRequest $request
     * @param RequestSupportAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(SupportRequest $request, RequestSupportAction $action)
    {
        return $action->execute(
            Auth::user()->portalUser,
            $request->comment,
            $request->type_request
        )->apiSuccess();
    }
}

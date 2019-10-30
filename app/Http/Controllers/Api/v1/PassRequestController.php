<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\PassRequest\NewPassRequestAction;
use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\v1\PassRequest\CreatePassRequest;
use App\Repositories\PassRequestRepository;
use App\Structure\PassRequest\PassRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\PassRequest\PassRequest as PassRequestResource;
use Illuminate\Support\Facades\Auth;

class PassRequestController extends Controller
{

    public function index(Request $request, PassRequestRepository $passRequestRepository)
    {
        return PassRequestResource::collection($passRequestRepository->getUserPassRequests(
            Auth::user()->portalUser
        )->orderBy('id', 'DESC')->paginate(15));
    }

    public function show(Request $request, PassRequestRepository $passRequestRepository, $id)
    {
        if (!$pass = $passRequestRepository->getUserPassRequest(Auth::user()->portalUser, $id))
            throw new ApiException(404, 'User Pass request not found.');

        return new PassRequestResource($pass);
    }

    public function store(CreatePassRequest $request, NewPassRequestAction $action)
    {
        $structure = new PassRequest(
            Auth::user()->portalUser->getUserAdLogin(),
            $request->type,
            $request->visitors,
            $request->phones,
            $request->get('comment', ''),
            Carbon::parse($request->date)->setHour(9)->setMinutes(0)->setSecond(0),
            $request->office_id
        );

        if (!$result = $action->execute(Auth::user()->portalUser, $structure)->getActionResult())
            throw new ApiException(422, 'Unknown validation error.');

        return $this->apiSuccess([
            'id' => $result->id
        ]);
    }

}

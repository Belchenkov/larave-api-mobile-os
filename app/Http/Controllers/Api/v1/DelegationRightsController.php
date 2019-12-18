<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\DelegationRights\NewDelegationRightAction;
use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\v1\DelegationRights\CreateDelegationRightsRequest;
use App\Http\Requests\Api\v1\DelegationRights\UpdateDelegationRightsRequest;
use App\Http\Resources\Api\v1\DelegationRights\DelegationRights;
use App\Repositories\DelegationRightsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class DelegationRightsController
 * @package App\Http\Controllers\Api\v1
 */
class DelegationRightsController extends Controller
{

    private $delegationRightsRepository;

    public function __construct()
    {
        $this->delegationRightsRepository = new DelegationRightsRepository();
    }

    public function index()
    {
        return DelegationRights::collection(
            $this->delegationRightsRepository
                ->getExecutors(Auth::user()->portalUser)
                ->simplePaginate(15)
        );
    }

    /**
     * @param $delegation_id
     * @return DelegationRights
     * Show Single Delegation Right
     */
    public function show($delegation_id)
    {
        if (!$delegation = $this->delegationRightsRepository->getDelegationById(Auth::user()->portalUser, $delegation_id)) {
            throw new ApiException(404, 'Delegation Right not found.');
        }

        return new DelegationRights($delegation);
    }

    /**
     * @param CreateDelegationRightsRequest $request
     * @param NewDelegationRightAction $action
     * @return \Illuminate\Http\JsonResponse
     * Create New Delegation Right
     */
    public function create(CreateDelegationRightsRequest $request, NewDelegationRightAction $action)
    {
        return $action->execute(
            Auth::user()->portalUser,
            $request->get('on_whom'),
            $request->get('period_start'),
            $request->get('period_end'),
            $request->get('is_active')
        )->apiSuccess();
    }

    public function update(UpdateDelegationRightsRequest $request)
    {
        dump('Update');
        dd($request->all());
    }
}

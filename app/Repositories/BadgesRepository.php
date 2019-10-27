<?php
/**
 * Created by black40x@yandex.ru
 * Date: 27/10/2019
 */

namespace App\Repositories;


use App\Structure\User\UserInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BadgesRepository
{
    private $approvalTaskRepository;

    public function __construct()
    {
        $this->approvalTaskRepository = new ApprovalTaskRepository();
    }

    public function getUserBadges(UserInterface $user, $cache = true) : Collection
    {
        $repository = $this;

        if (!$cache)
            $this->clearUserBadgesCache($user);

        return Cache::rememberForever('badges.' . $user->getUserPhPerson(), function () use ($user, $repository) {
            return collect([
                'approval' => $repository->approvalTaskRepository->getUserTasks($user)->count(),
                'messages' => 0,
                'tasks' => 0
            ]);
        });
    }

    public function clearUserBadgesCache(UserInterface $user)
    {
        Cache::forget('badges.' . $user->getUserPhPerson());
    }

}

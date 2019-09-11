<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\Profile\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\v1
 * Profile info (Личная кадровая информация)
 */
class ProfileController
{
    /**
     * Get Profile Info for Auth User
     * @return mixed
     */
    public function getProfileInfo()
    {
        return Cache::remember('getProfileInfo', config('cache.cache_time'), function () {
            return new Profile(Auth::user()->load('phPerson', 'employee', 'department', 'employeeStatus', 'employeeChief'));
        });
    }
}

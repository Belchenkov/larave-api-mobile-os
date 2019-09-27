<?php
/**
 * Created by black40x@yandex.ru
 * Date: 24/09/2019
 */

namespace App\Services\User;


use App\Repositories\User\StatisticVisitRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

trait UserTrait
{

    private $avatarColors = [
        ['#ec3f7a', '#ffffff'],
        ['#7b7b7b', '#ffffff'],
        ['#fd8383', '#ffffff'],
        ['#a73c3c', '#ffffff'],
        ['#673ab7', '#ffffff'],
        ['#3f51b5', '#ffffff'],
        ['#2196f3', '#ffffff'],
        ['#00bcd4', '#ffffff'],
        ['#009688', '#ffffff'],
        ['#4caf50', '#ffffff'],
        ['#cddc39', '#424242'],
        ['#ffeb3b', '#424242'],
        ['#ffc107', '#ffffff'],
        ['#ff9800', '#ffffff'],
        ['#795548', '#ffffff'],
    ];

    public function getAvatarColor() : array
    {
        $color_count = count($this->avatarColors);
        $color_index = crc32($this->getFullName()) % $color_count;
        return $this->avatarColors[$color_index];
    }

    /**
     * @return string
     */
    public function getShortName() : string
    {
        if (!$name = $this->getFullname()) return 'NA';

        $name = explode(' ', $name);
        if (count($name) >= 2) {
            return strtoupper(mb_substr($name[0], 0, 1) . mb_substr($name[1], 0, 1));
        }
        return strtoupper(mb_substr($name[0], 0, 1));
    }

    /**
     * @return string
     */
    public function getOfficeAddress() : ?string
    {
        $office = $this->getOffice();

        if (strpos($office, '/')) {
            return trim(explode('/', $office)[0], ' ');
        } elseif (strpos($office, '\\')) {
            return trim(explode('\\', $office)[0], ' ');
        }

        return $office;
    }

    /**
     * @return string|null
     */
    public function getCabinet() : ?string
    {
        $office = $this->getOffice();

        if (strpos($office, '/')) {
            return trim(explode('/', $office)[1], ' ');
        } elseif (strpos($office, '\\')) {
            return trim(explode('\\', $office)[1], ' ');
        }

        return null;
    }

    /**
     * @return mixed|string
     * Get Holidays User
     */
    public function getHolidays() : ?Collection
    {
        $holidays = null;

        if ($employeeStatus = $this->employeeStatus) {
            $holidays = (new StatisticVisitRepository)->checkHolidayUser($employeeStatus, Carbon::now());
        }

        return $holidays;
    }

    /**
     * @return int|null
     * Get Amount Holiday Days Employee
     */
    public function getCountHolidayDays() : ?int
    {
        if ($holidays = $this->getHolidays()) {
            $holidaysStart = Carbon::parse($holidays['date_start']);
            $holidaysEnd = Carbon::parse($holidays['date_end']);

            return $holidaysEnd->diffInDays($holidaysStart);
        }

        return null;
    }

    /**
     * @return string
     * Get Status Employee
     */
    public function getStatus() : string
    {
        return $this->getHolidays() ? $this->getHolidays()['status'] : 'Работает';
    }

    /**
     * @return bool
     */
    public function isUserOnline() : bool
    {
        // Protect for a load in paginate list
        if ($this->relationLoaded('skudEvents')) {
            if ($this->skudEvents->last() && $this->skudEvents->last()->direction == StatisticVisitRepository::VISIT_ENTER) return true;
        }

        return false;
    }

    public function isChief() : bool
    {
        if ($this->departmentChief->count() > 0) {
            return true;
        }

        return false;
    }

    public function getUserAvatar($update = false)
    {
        $file_name_source = $this->getTabNo() . '_2.jpg';
        $file_name_avatar = $this->getPhPerson() . '.jpg';
        $avatar_path = public_path('uploads/avatars/' . $file_name_avatar);
        $source_path = config('workflow.avatars_path') . $file_name_source;

        if (\File::exists($avatar_path)) {
            $need_update = false;

            if ($update) {
                if (\File::exists($source_path)) {
                    if (filemtime($source_path) > filemtime($avatar_path)) {
                        $need_update = true;
                    }
                }
            }

            if (!$need_update)
                return request()->getUriForPath('/uploads/avatars/' . $file_name_avatar);
        }

        if (\File::exists($source_path)) {
            if (!\File::exists(public_path('uploads/avatars'))) {
                \File::makeDirectory(public_path('uploads/avatars'), 0755, true);
            }

            \File::copy($source_path, $avatar_path);

            if ($update) {
                $image = Image::make($avatar_path);
                $image->resize(250, 250);
                $image->save();
            }

            return request()->getUriForPath('/uploads/avatars/' . $file_name_avatar);
        }

        return null;
    }

}

<?php
/**
 * Created by black40x@yandex.ru
 * Date: 09/10/2019
 */

namespace App\Structure\User;


use App\Structure\CustomStdObject;
use Intervention\Image\Facades\Image;


class UserAvatar
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

    private $user;

    public function __construct(?UserInterface $user)
    {
        $this->user = $user;
    }

    public function setFakerUser(CustomStdObject $user)
    {
        $this->user = $user;
        return $this;
    }

    static function fromFaker($last_name, $first_name, $middle_name, $tab_no, $id_phperson) : UserAvatar
    {
        $user = new CustomStdObject();
        $data = [
            'last_name' => $last_name,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'tab_no' => $tab_no,
            'id_phperson' => $id_phperson,
        ];

        $user->getUserFullName = function () use ($data) {
            return $data['last_name'] . ' ' . $data['first_name'] . ' ' . $data['middle_name'];
        };

        $user->getUserTabNo = function () use ($data) {
            return $data['tab_no'];
        };

        $user->getUserPhPerson = function () use ($data) {
            return $data['id_phperson'];
        };

        return (new self(null))->setFakerUser($user);
    }

    /**
     * @return string
     * Get First Letter of FirstName && LastName
     */
    public function getShortName() : string
    {
        if (!$name = $this->user->getUserFullName()) return 'NA';

        $name = explode(' ', $name);
        if (count($name) >= 2) {
            return strtoupper(mb_substr($name[0], 0, 1) . mb_substr($name[1], 0, 1));
        }
        return strtoupper(mb_substr($name[0], 0, 1));
    }

    public function getAvatarColor() : array
    {
        $color_count = count($this->avatarColors);
        $color_index = crc32($this->user->getUserFullName()) % $color_count;
        return $this->avatarColors[$color_index];
    }

    /**
     * @param bool $update
     * @return string|null
     */
    public function getUserAvatarImage(bool $update = false) : ?string
    {
        $file_name_source = $this->user->getUserTabNo() . '_2.jpg';
        $file_name_avatar = $this->user->getUserPhPerson() . '.jpg';
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

            //if ($update) {
                $image = Image::make($avatar_path);
                $image->resize(250, 250);
                $image->save();
            //}

            return request()->getUriForPath('/uploads/avatars/' . $file_name_avatar);
        }

        return null;
    }

    /**
     * @param bool $update
     * @return array
     * Get Avatar Info - array view
     */
    public function toArray(bool $update = false) : array
    {
        $color = $this->getAvatarColor();

        return [
            'name' => $this->getShortName(),
            'background' => $color[0],
            'color' => $color[1],
            'image' => $this->getUserAvatarImage($update),
        ];
    }

}

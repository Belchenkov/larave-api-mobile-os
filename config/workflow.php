<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */


return [

    'pin' => [
        'life_time' => env('APP_PINCODE_LIFETIME', 5) * 60
    ],

    'avatars_path' => env('APP_AVATARS_PATH')
];

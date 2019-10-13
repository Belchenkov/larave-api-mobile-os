<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */


return [

    'pin' => [
        'life_time' => env('APP_PINCODE_LIFETIME', 5) * 60
    ],

    'avatars_path' => env('APP_AVATARS_PATH'),
    'time_update_new_approval_tasks' => 5,
    'time_update_late_users' => 5,
    'callback_key' => env('APP_CALLBACK_KEY'),

    'doc_download' => env('APP_DOC_DOWNLOAD_URL'),
    'doc_download_user' => env('APP_DOC_DOWNLOAD_USER'),
    'doc_download_pass' => env('APP_DOC_DOWNLOAD_PASS'),
];

<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

return [

    'pin' => [
        'life_time' => env('APP_PINCODE_LIFETIME', 5) * 60
    ],

    'admin_ip_range' => env('ADMIN_IP_RANGE'),

    'avatars_path' => env('APP_AVATARS_PATH'),
    'time_update_new_approval_tasks' => 1,
    'time_update_late_users' => 1,
    'callback_key' => env('APP_CALLBACK_KEY'),

    'doc_download' => env('APP_DOC_DOWNLOAD_URL'),
    'doc_download_user' => env('APP_DOC_DOWNLOAD_USER'),
    'doc_download_pass' => env('APP_DOC_DOWNLOAD_PASS'),

    'intranet_base_url' => env('APP_INTRANET_BASE_URL'),
    'intranet_auth_login' => env('APP_INTRANET_AUTH_LOGIN'),
    'intranet_auth_password' => env('APP_INTRANET_AUTH_PASSWORD'),
    'intranet_login' => env('APP_INTRANET_LOGIN'),
    'intranet_password' => env('APP_INTRANET_PASSWORD'),

    'tableau_url' => env('TABLEAU_URL'),
    'tableau_user' => env('TABLEAU_USER'),
];

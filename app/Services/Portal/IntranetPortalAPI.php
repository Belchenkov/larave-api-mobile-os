<?php
/**
 * Created by black40x@yandex.ru
 * Date: 22.11.2019
 */

namespace App\Services\Portal;


use App\Structure\User\UserInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class IntranetPortalAPI
{

    private $base_url;
    private $token_refresh = false;
    private $auth_base_login;
    private $auth_base_password;
    private $auth_login;
    private $auth_password;
    private $auth_token;

    public function __construct()
    {
        $this->base_url = config('workflow.intranet_base_url');
        $this->auth_base_login = config('workflow.intranet_auth_login');
        $this->auth_base_password = config('workflow.intranet_auth_password');
        $this->auth_login = config('workflow.intranet_login');
        $this->auth_password = config('workflow.intranet_password');

        $this->login();
    }

    public function login($no_cache = false)
    {
        $api = $this;

        if ($no_cache)
            Cache::forget('intranet.auth.token');

        $res = Cache::rememberForever('intranet.auth.token', function () use ($api) {
            $res = $api->doRequest('api/login', 'post', [
                'form_params' => [
                    'login' => $api->auth_login,
                    'password' => $api->auth_password,
                ]
            ]);

            return $res;
        });
        if ($res) {
            $this->auth_token = $res['token'];
            return true;
        }

        return false;
    }

    public function getInitiatorKip(UserInterface $user, $as_json = true)
    {
        $res = $this->doRequest('zskp/kip/api/initiator-kip', 'get', [
            'json' => [
                'id_phperson' => $user->getUserPhPerson()
            ]
        ], $as_json);

        if (isset($res['error'])) $r = [];

        return collect($res);
    }

    public function getExecutorKip(UserInterface $user, $as_json = true)
    {
        $res = $this->doRequest('zskp/kip/api/executor-kip', 'get', [
            'json' => [
                'id_phperson' => $user->getUserPhPerson()
            ]
        ], $as_json);

        if (isset($res['error'])) $r = [];

        return collect($res);
    }

    public function getKip(UserInterface $user, $kip_id, $as_json = true)
    {
        $res = $this->doRequest('zskp/kip/api/get-kip', 'get', [
            'json' => [
                'id' => $kip_id,
                'id_phperson' => $user->getUserPhPerson(),
            ]
        ], $as_json);

        return collect($res);
    }

    public function getFile($file_id)
    {
        return $this->doRequest('zskp/kip/api/get-file', 'get', [
            'query' => [
                'file_id' => $file_id
            ]
        ], false);
    }

    public function doRequest($entry_point = '', $method = 'get', $data = [], $as_json = true)
    {
        if ($entry_point != 'api/login' && !$this->auth_token) {
            $this->login(true);

            if (!$this->auth_token && !$this->token_refresh) {
                return false;
            }
        }

        if ($this->auth_token) {
            if (isset($data['query'])) {
                $data['query']['access-token'] = $this->auth_token;
            } else
                $data['query'] = [
                    'access-token' => $this->auth_token
                ];
        }

        try {
            $client = new Client([
                'base_uri' => $this->base_url,
                'timeout' => 15.0,
                'auth' => [
                    $this->auth_base_login,
                    $this->auth_base_password
                ]
            ]);

            switch ($method) {
                case 'post':
                    $response = $client->post($entry_point, $data);
                    break;
                case 'get':
                default:
                    $response = $client->get($entry_point, $data);
                    break;
            }

            $this->token_refresh = false;

            if ($as_json) {
                return json_decode($response->getBody(), true);
            }

            return $response;
        } catch  (\Exception $e) {
            if ($e->getCode() == 401) {
                $this->auth_token = false;

                if (!$this->token_refresh) {
                    $this->token_refresh = true;
                    $this->login(true);
                    return $this->doRequest($entry_point, $method, $data);
                }
            }
        }

        return false;
    }


}

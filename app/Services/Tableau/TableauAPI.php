<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04.12.2019
 */

namespace App\Services\Tableau;


use App\Exceptions\Api\ApiException;
use GuzzleHttp\Client;

class TableauAPI
{
    private $user_name;
    private $base_url;

    public function __construct()
    {
        $this->user_name = config('workflow.tableau_user');
        $this->base_url = config('workflow.tableau_url');

        if (!$this->user_name)
            throw new ApiException(500, 'Tableau user not found.');
    }

    /**
     * Get trusted URL from share link of tableau
     *
     * @param $url
     * @return mixed
     */
    public function getUrlWithTicket($url)
    {
        $ticket = $this->getTicket();
        return str_replace($this->base_url, $this->base_url . 'trusted/' . $ticket . '/', $url);
    }

    public function getTicket()
    {
        $res = $this->doPostRequest('trusted', [
            'username' => $this->user_name
        ]);

        if ($res !== false && $res->getStatusCode() == 200) {
            $body = $res->getBody()->getContents();

            if ($body == '-1') {
                throw new ApiException(500, 'Ticket create error.');
            }

            return $body;
        }

        return false;
    }

    private function doPostRequest($entry_point, $data)
    {
        try {
            $client = new Client([
                'verify' => false,
                'base_uri' => $this->base_url,
                'timeout' => 15.0,
            ]);

            return $client->post($entry_point, $data);
        } catch (\Exception $e) {
        }

        return false;
    }
}

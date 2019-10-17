<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class UserCatalogTest extends TestCase
{

    public function test_UserCatalogUnauthorized()
    {
        $response = $this->get('/api/v1/users/catalog');
        $response->assertStatus(401);
    }

    public function test_UserCatalog()
    {
        $this->be($this->factoryUser(), 'api');
        $response = $this->get('/api/v1/users/catalog');
        $response->assertStatus(200);

        $id_phperson = $response->json('data.0.id_phperson');
        $response = $this->get('/api/v1/users/catalog/' . urlencode($id_phperson));
        $response->assertStatus(200);

        $response = $this->get('/api/v1/users/catalog/' . urlencode($id_phperson) . '/visits');
        $response->assertStatus(200);

        $response = $this->get('/api/v1/users/catalog?my=1');
        $response->assertStatus(200);
    }

}

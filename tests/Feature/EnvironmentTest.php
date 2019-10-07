<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{

    /**
     * Test exist user avatar directory
     */
    public function test_AvatarDirectory()
    {
        $this->assertDirectoryExists(config('workflow.avatars_path'));
    }

    /**
     * Test to access 1C download document server
     */
    public function test_1CDocumentServer()
    {
        $code = 0;

        try {
            $client = new Client([
                'base_uri' => config('workflow.doc_download'),
                'timeout' => 10.0,
                'auth' => [
                    config('workflow.doc_download_user'),
                    config('workflow.doc_download_pass')
                ]
            ]);
            $client->get('?id=dd1bae85-4653-11e9-90ff-00155d501402');
        } catch (\Exception $exception) {
            $code = $exception->getCode();
        }

        $this->assertEquals($code, 400);
    }

    /**
     * Test connection to database
     */
    public function test_DatabaseConnection()
    {
        $connect = false;

        try {
            $this->getConnection('sqlsrv')->getPdo();
            $connect = true;
        } catch (\Exception $exception) {
        }

        $this->assertEquals($connect, true);
    }

    /**
     * Test connection to transit database
     */
    public function test_TransitDatabaseConnection()
    {
        $connect = false;

        try {
            $this->getConnection('sqlsrv_transition')->getPdo();
            $connect = true;
        } catch (\Exception $exception) {
        }

        $this->assertEquals($connect, true);
    }
}

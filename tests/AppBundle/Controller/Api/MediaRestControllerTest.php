<?php

namespace Tests\AppBundle\Controller\Api;

use Tests\AppBundle\Fixtures\AbstractTestCase;

class WelcomeControllerTest extends AbstractTestCase
{
    public function testGetBasicMediaInfo()
    {
        $client   = new \GuzzleHttp\Client();
        $response = $client->request(
            'GET',
            'http://localhost:8000/api/media/1/info/basic',
            [
                'headers' => $this->getAuthorizedHeaders('admin')
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetFullMediaInfo()
    {
        $client   = new \GuzzleHttp\Client();
        $response = $client->request(
            'GET',
            'http://localhost:8000/api/media/1/info/full',
            [
                'headers' => $this->getAuthorizedHeaders('admin')
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
    }
}
<?php

namespace Tests\AppBundle\Controller\Api;


use Tests\AppBundle\Fixtures\AbstractTestCase;

class ContactControllerTest extends AbstractTestCase
{
    public function tesGetBasicMediaInfo()
    {
        $crawler = $this->client->request('GET', 'api/media/1/info/basic');

        $this->assertJsonResponse($this->client->getResponse(), 200);
    }

    public function testFullMediaInfo()
    {
        $crawler = $this->client->request('GET', 'api/media/1/info/full');

        $this->assertJsonResponse($this->client->getResponse(), 200);
    }
}
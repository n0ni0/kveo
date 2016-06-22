<?php

namespace tests\AppBundle\Controller;

use Tests\AppBundle\Fixtures\AbstractTestCase;

class CollectionControllerTest extends AbstractTestCase
{
    public function testThatShowCollections()
    {
        $crawler = $this->client->request('GET', '/username/collection/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(1, $crawler->filter('h2:contains("Colección")')->count());

    }
}
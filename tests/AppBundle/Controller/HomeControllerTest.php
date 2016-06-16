<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\Fixtures\AbstractTestCase;

class HomeControllerTest extends AbstractTestCase
{
    public function testThatLoadHomePage()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div#carousel')->count());
    }

    public function testThatLoadUserDropDownMenu()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(1, $crawler->filter('div[class="dropdown"]')->count());
    }
}
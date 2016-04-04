<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'username',
        ));
    }

    public function testThatLoadHomePage()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div#carousel')->count());
    }
}
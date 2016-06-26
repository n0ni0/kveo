<?php

namespace tests\AppBundle\Controller;

use Tests\AppBundle\Fixtures\AbstractTestCase;

class MediaControllerTest extends AbstractTestCase
{
    public function testThatShowMediaContents()
    {
        $crawler = $this->client->request('GET', '/media/title-1/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(1, $crawler->filter('h3:contains("Title 1")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Serie | 2011 | Crimen")')->count());

        $this->assertEquals(1, $crawler->filter('a:contains("Ver trailer")')->count());

        $this->assertEquals(1, $crawler->filter('img#ximage')->count());
        
    }
}
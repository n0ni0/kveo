<?php

namespace tests\AppBundle\Controller;


use Tests\AppBundle\Fixtures\AbstractTestCase;

class PersonControllerTest extends AbstractTestCase
{
    public function testShowPerson()
    {
        $crawler = $this->client->request('GET', '/person/jim-parsons');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(1, $crawler->filter('h3:contains("Jim Parsons")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Nacido en: Texas")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Edad: 43")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Biografía: James Joseph Parsons, más conocido como Jim Parsons")')->count());
    }
}
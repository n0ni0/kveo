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

    public function testThatLoadMediaTypesInNabvar()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(1, $crawler->filter('a:contains("Peliculas")')->count());
        $this->assertEquals(1, $crawler->filter('a:contains("Series")')->count());
        $this->assertEquals(1, $crawler->filter('a:contains("Documentales")')->count());
        $this->assertEquals(1, $crawler->filter('a:contains("Programas")')->count());
        $this->assertEquals(1, $crawler->filter('a:contains("Tendencias")')->count());
        $this->assertEquals(1, $crawler->filter('a:contains("Colección")')->count());
    }

    public function testThatLoadTrendsAtHome()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertGreaterThan(5, $crawler->filter('div.media-card')->count());
    }

    public function testThatLoadFooterContents()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(2, $crawler->filter('a:contains("kveo")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Creado por Antonio Jiménez Velázquez")')->count());
        $this->assertEquals(1, $crawler->filter('a:contains("Github")')->count());
        $this->assertEquals(1, $crawler->filter('a:contains("Contacto")')->count());
    }
}
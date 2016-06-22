<?php

namespace tests\AppBundle\Profile;

use Tests\AppBundle\Fixtures\AbstractTestCase;

class EditUserProfileTest extends AbstractTestCase
{
    public function testThatUserCanAccesTheirProfile()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link    = $crawler->selectLink('Perfil')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(1, $crawler->filter('html:contains("Información personal")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Nombre de usuario: username")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Email: username@kveo.local")')->count());
    }
}
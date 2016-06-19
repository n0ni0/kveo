<?php

namespace tests\AppBundle\Controller;

use Tests\AppBundle\Fixtures\AbstractTestCase;

class StateControllerTest extends AbstractTestCase
{
    public function testNewState()
    {
        $crawler = $this->client->request('POST', '/media/1/state/new/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Enviar')->form();
        $form['app_state[mediaState]'] = 1;
        
        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("Reparto")')->count());
    }


    public function testEditState()
    {
        $crawler = $this->client->request('POST', '/media/1/state/edit');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Enviar')->form();
        $form['app_state[mediaState]'] = 3;

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("Reparto")')->count());
    }

    public function testDeleteState()
    {
        $crawler = $this->client->request('POST', '/media/1/state/edit');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link    = $crawler->selectLink('Borrar estado')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(1, $crawler->filter('html:contains("Reparto")')->count());
    }
}
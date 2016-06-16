<?php

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\Fixtures\AbstractTestCase;

class ContactControllerTest extends AbstractTestCase
{
    public function testContactForm()
    {
        $crawler = $this->client->request('POST', '/contact/');

        $this->assertEquals(1, $crawler->filter('html:contains("Formulario de contacto")')->count());

        $form = $crawler->selectButton('Enviar')->form();
        $form['app_contact[message]'] = "This is a example of contact message";

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("Su mensaje se ha enviado correctamente")')->count());
    }
}
<?php

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'username',
        ));
    }

    public function testContactForm()
    {
        $crawler = $this->client->request('POST', '/contact/');

        $this->assertEquals(1, $crawler->filter('h3:contains("Formulario de contacto")')->count());

        $form = $crawler->selectButton('Enviar')->form();
        $form['app_contact[message]'] = "This is a example of contact message";

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("Su mensaje se ha enviado correctamente")')->count());
    }
}
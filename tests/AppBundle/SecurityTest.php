<?php

use Symfony\Component\HttpFoundation\Response;
use Tests\AppBundle\Fixtures\AbstractTestCase;

class SecurityTest extends AbstractTestCase
{
    public function testUsersAnonymousRedirectsToLogin()
    {
        $url = ('/catalog/1/');
        $this->client->request('GET', $url);
    }

    public function testUserRegisteredCanAccessToContent()
    {
        $this->client->request('GET', '/catalog/1/');
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

    }

    public function testAdminCanAccessToTheBackend()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));

        $this->client->request('GET', '/boss/?action=list&entity=Comment');
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
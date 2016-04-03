<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityTest extends WebTestCase
{
    public function testUsersAnonymousRedirectsToLogin()
    {
        $url = ('/catalog/1/');
        $client = self::createClient();
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertEquals(
            'http://localhost/login',
            $client->getResponse()->getTargetUrl(),
            sprintf('The %s secure URL redirects to the login form.', $url)
        );
    }

    public function testUserRegisteredCanAccessToContent()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'username',
        ));

        $client->request('GET', '/catalog/1/');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

    }

    public function testAdminCanAccessToTheBackend()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'nonio',
            'PHP_AUTH_PW'   => 'nonio',
        ));

        $client->request('GET', '/boss/?action=list&entity=Comment');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
<?php

namespace tests\AppBundle\Fixtures;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/**
 * Class AbstractTestCase. Code copied from
 * https://github.com/Orbitale/CmsBundle/blob/master/Tests/Fixtures/AbstractTestCase.php
 * (c) Alexandre Rock Ancelet <alex@orbitale.io>.
 */
abstract class AbstractTestCase extends WebTestCase
{
    /** @var Client */
    protected $client;
    protected function setUp()
    {
        $this->initClient();
        $this->initDatabase();
    }

    protected function tearDown()
    {
        $this->client = null;
    }

    protected function initClient()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'username',
        ));
    }
    
    /**
     * It ensures that the database contains the original fixtures of the
     * application. This way tests can modify its contents safely without
     * interfering with subsequent tests.
     */
    protected function initDatabase()
    {
        $buildDir = 'build/';
        copy($buildDir.'/original_test.db', $buildDir.'/test.db');
    }

    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode,
            $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }

    protected function getService($id)
    {
        return self::$kernel->getContainer()
            ->get($id);
    }

    protected function getAuthorizedHeaders($username, $headers = array())
    {
        $token = $this->getService('lexik_jwt_authentication.encoder')
            ->encode(['username' => $username]);
        $headers['Authorization'] = 'Bearer '.$token;
        return $headers;
    }
}
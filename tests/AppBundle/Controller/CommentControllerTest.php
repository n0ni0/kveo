<?php

namespace tests\AppBundle\Controller;


use Tests\AppBundle\Fixtures\AbstractTestCase;

class CommentControllerTest extends AbstractTestCase
{
    public function testComment()
    {
        $crawler = $this->client->request('POST', '/media/title-1/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a#edit-comment')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Editar comentario')->form();
        $form['app_comment[comment]'] = "Edit test comment";

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("Edit test comment")')->count());
    }

    public function testDeleteComment()
    {
        $crawler = $this->client->request('POST', '/media/title-1/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(1, $crawler->filter('html:contains("Test comment")')->count());

        $link = $crawler->filter('a#delete-comment')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(0, $crawler->filter('html:contains("Test comment")')->count());
    }

    public function testThatAdminCanEditComments()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));

        $crawler = $this->client->request('POST', '/media/title-1/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a#edit-comment')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Editar comentario')->form();
        $form['app_comment[comment]'] = "Edit test comment";

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("Edit test comment")')->count());
    }

    public function testThatAdminCanDeleteComments()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));

        $crawler = $this->client->request('POST', '/media/title-1/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(1, $crawler->filter('html:contains("Test comment")')->count());

        $link = $crawler->filter('a#delete-comment')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(0, $crawler->filter('html:contains("Test comment")')->count());
    }
}
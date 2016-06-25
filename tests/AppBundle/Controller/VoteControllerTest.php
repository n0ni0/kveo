<?php


namespace tests\AppBundle\Controller;

use Tests\AppBundle\Fixtures\AbstractTestCase;

class VoteControllerTest extends AbstractTestCase
{
    private $em;
    
    public function testNewVote()
    {
        $crawler = $this->client->request('POST', '/media/title-1/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Valoración')->form();
        $form['app_vote[rating]'] = 5;

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $result = $this->getUserVote()->getRating();
        $this->assertEquals(5, $result);
    }

    public function testEditVote()
    {
        $crawler = $this->client->request('POST', '/media/title-1/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Valoración')->form();
        $form['app_vote[rating]'] = 2;

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $result = $this->getUserVote()->getRating();
        $this->assertEquals(2, $result);
    }

    public function getUserVote()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        return $this->em->getRepository('AppBundle:Vote')->findOneById(1);
    }
}
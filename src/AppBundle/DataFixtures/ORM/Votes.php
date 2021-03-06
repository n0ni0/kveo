<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Vote;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Votes extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 100;
    }

    public function load(ObjectManager $manager)
    {
        $medias      = $manager->getRepository('AppBundle:Media')->findAllMediasExceptTest();
        $users       = $manager->getRepository('AppBundle:User')->findAll();

        $testState = new Vote();
        $testState->setMedia($this->getReference('media'));
        $testState->setUser($this->getReference('username'));
        $testState->setRating(4);
        $manager->persist($testState);

        for($i=2; $i < 30; $i++) {

            $media       = $medias[array_rand($medias)];
            $vote        = rand(0, 5);
            $user        = $users[array_rand($users)];

            $state = new Vote();
            $state->setMedia($media);
            $state->setUser($user);
            $state->setRating($vote);
            $manager->persist($state);
        }

        $manager->flush();
    }
}
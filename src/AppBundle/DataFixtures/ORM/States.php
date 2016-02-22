<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\State;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class States extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 90;
    }

    public function load(ObjectManager $manager)
    {
        for($i=0; $i < 30; $i++) {
            $medias      = $manager->getRepository('AppBundle:Media')->findAll();
            $mediaStates = $manager->getRepository('AppBundle:MediaState')->findAll();
            $users       = $manager->getRepository('AppBundle:User')->findAll();

            $media       = $medias[array_rand($medias)];
            $mediaState  = $mediaStates[array_rand($mediaStates)];
            $user        = $users[array_rand($users)];

            $state = new State();
            $state->setMedia($media);
            $state->setUser($user);
            $state->setMediaState($mediaState);
            $manager->persist($state);
        }

        $manager->flush();
    }
}
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
        $medias      = $manager->getRepository('AppBundle:Media')->findAll();
        $mediaStates = $manager->getRepository('AppBundle:MediaState')->findAll();
        $users       = $manager->getRepository('AppBundle:User')->findAll();

        for($i=1; $i < 30; $i++) {

            $media       = $medias[array_rand($medias)];
            $mediaState  = $mediaStates[array_rand($mediaStates)];
            $user        = $users[array_rand($users)];

            $state = new State();
            $state->setMedia($media);
            $state->setUser($user);
            $state->setMediaState($mediaState);
            $manager->persist($state);
        }

        $testState = new State();
        $testState->setMedia($this->getReference('media'));
        $testState->setUser($this->getReference('username'));
        $testState->setMediaState($mediaStates[1]);
        $manager->persist($testState);

        $manager->flush();
    }
}
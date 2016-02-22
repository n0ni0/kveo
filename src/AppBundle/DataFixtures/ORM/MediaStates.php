<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\MediaState;

class MediaStates extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 30;
    }

    public function load(ObjectManager $manager)
    {
        $mediaStates = array(
            'Siguiendo',
            'Pendiente',
            'Finalizada',
        );

        foreach($mediaStates as $mediaState){
            $mediaStates = new Mediastate();
            $mediaStates->setName($mediaState);

            $manager->persist($mediaStates);
        }

        $manager->flush();
    }
}
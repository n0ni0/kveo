<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\MediaType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class MediaTypes extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 10;
    }

    public  function load(ObjectManager $manager)
    {
        $mediaTypes = array(
            'Documental',
            'Película',
            'Serie',
            'TV Show',
        );

        foreach($mediaTypes as $mediaType){
            $mediaTypes = new MediaType();
            $mediaTypes->setName($mediaType);

            $manager->persist($mediaTypes);
        }

        $manager->flush();
    }

}
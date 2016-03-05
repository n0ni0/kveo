<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\MediaType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class MediaTypes extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

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
            'Programa',
        );

        foreach($mediaTypes as $mediaType){
            $mediaTypes = new MediaType();
            $mediaTypes->setName($mediaType);
            $mediaTypes->setSlug($this->container->get('slugger')->slugify($mediaTypes->getName()));

            $manager->persist($mediaTypes);
        }

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
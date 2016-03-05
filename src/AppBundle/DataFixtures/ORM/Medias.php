<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Media;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Medias extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 70;
    }

    public function load(ObjectManager $manager)
    {
        for($i=1; $i <1000; $i++) {

            $mediaTypes = $manager->getRepository('AppBundle:MediaType')->findAll();
            $genders    = $manager->getRepository('AppBundle:Gender')->findAll();
            $mediaType  = $mediaTypes[array_rand($mediaTypes)];
            $gender     = $genders[array_rand($mediaTypes)];

            $media = new Media();
            $media->setMediaType($mediaType);
            $media->setGender($gender);
            $media->setTitle('Title '.$i);
            $media->setSlug($this->container->get('slugger')->slugify($media->getTitle()));
            $media->setYear(rand(1980, 2016));
            $media->setPlot(
                $i.'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut,
                imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.
                Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in,
                viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                Nam eget dui. Etiam rhoncus.'
            );
            $media->setImg('kveo-walkingDead.jpg');
            $media->setTrailer('https://www.youtube.com/watch?v=R1v0uFms68U');
            $manager->persist($media);

        }
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
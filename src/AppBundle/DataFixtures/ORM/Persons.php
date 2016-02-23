<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Person;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Persons extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 60;
    }

    public function  load(ObjectManager $manager)
    {
        $stallone = new Person();
        $stallone->setName('Silvester Stallone');
        $stallone->setSlug($this->container->get('slugger')->slugify($stallone->getName()));
        $stallone->setAge(63);
        $stallone->setBirthplace('New York');
        $stallone->setBiography('Biografia');
        $manager->persist($stallone);

        $andrew = new Person();
        $andrew->setName('Andrew Lincoln');
        $andrew->setSlug($this->container->get('slugger')->slugify($andrew->getName()));
        $andrew->setAge(42);
        $andrew->setBirthplace('London - England - UK');
        $andrew->setBiography('From Wikipedia, the free encyclopedia. Andrew Lincoln (born Andrew James Clutterbuck;
         14 September 1973 is an English actor, known for his roles in the TV series This Life,
         Teachers and afterlife, and the films Love Actually and Heartbreaker.
         He currently plays the lead role in AMC\'s television series The Walking Dead based upon the comic book
         series of the same name. Description above from the Wikipedia article Andrew Lincoln,
         licensed under CC-BY-SA, full list of contributors on Wikipedia. ');
        $manager->persist($andrew);

        $emily = new Person();
        $emily->setName('Emily Kinney');
        $emily->setSlug($this->container->get('slugger')->slugify($emily->getName()));
        $emily->setAge(30);
        $emily->setBirthplace('Nebraska - USA');
        $emily->setBiography('From Wikipedia, the free encyclopedia. Emily Kinney (born August 15, 1985 height
         is an American actress and singer. She is best known for her role as Beth Greene in th
         AMC television series The Walking Dead. ');
        $manager->persist($emily);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
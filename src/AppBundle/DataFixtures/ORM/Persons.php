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
        for($i=1; $i <100; $i++) {
            $person = new Person();
            $person->setName('Person'.$i);
            $person->setSlug($this->container->get('slugger')->slugify($person->getName()));
            $person->setAge(rand(16, 89));
            $person->setBirthplace($this->getBirthPace());
            $person->setBiography(
                'Person'.$i.'  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut,
                imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                Integer tincidunt. Cras dapibus.'
            );
            $manager->persist($person);
        }

        $manager->flush();
    }

    public function getBirthPace()
    {
        $birthPlace = array(
            'Albania',
            'Alemania',
            'Argentina',
            'Australia',
            'Austria',
            'Bélgica',
            'Bulgaria',
            'China',
            'Colombia',
            'Cuba',
            'España',
            'Estados Unidos',
            'Francia',
            'Grecia',
            'Guatemala',
            'Italia',
            'Portugal',
            'Reino Unido',
            'Vietnam'
        );

        return $birthPlace[array_rand($birthPlace)];
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
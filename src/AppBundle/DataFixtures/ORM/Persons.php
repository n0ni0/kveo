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

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function  load(ObjectManager $manager)
    {
            $person = new Person();
            $person->setName('Jim Parsons');
            $person->setAge(43);
            $person->setBirthplace('Texas');
            $person->setBiography(
                'James Joseph Parsons, más conocido como Jim Parsons (24 de marzo de 1973), es un actor 
                estadounidense de televisión, teatro y cine. Ha ganado múltiples premios debido a su peculiar 
                forma de actuar, incluidos el de Television Critics Association, el National Association of Broadcasters,
                cuatro Premios Emmy y también un Premio Globo de Oro por mejor actor de comedia en serie de televisión.
                Su papel más conocido es el de Sheldon Cooper, un físico teórico, uno de los personajes principales
                de la serie televisiva The Big Bang Theory dirigida por Chuck Lorre, de gran éxito en Estados Unidos.
                Por este papel, obtuvo el Premio Emmy a mejor actor protagonista de comedia en 2010, 2011, 2013, 2014 y
                el Globo de Oro, también como mejor actor protagonista de comedia en 2011.'
            );
            $this->addReference('person', $person);
            $manager->persist($person);

            $person2 = new Person();
            $person2->setName('KALEY CUOCO');
            $person2->setAge(31);
            $person2->setBirthplace('California');
            $person2->setBiography(
                'Kaley Christine Cuoco (30 de noviembre de 1985; Camarillo, California, Estados Unidos),
                 más conocida como Kaley Cuoco, es una actriz estadounidense conocida principalmente por el papel de Penny
                 en la comedia The Big Bang Theory y por el de Billie Jenkins en la serie Charmed.'
            );
            $manager->persist($person2);


        $manager->flush();
    }
}
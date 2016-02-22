<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Gender;

class Genders extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 20;
    }

    public function load(ObjectManager $manager)
    {
        $genders = array(
            'Acción',
            'Animación',
            'Aventura',
            'Ciencia Ficción',
            'Cine Negro',
            'Comedia',
            'Crimen',
            'Deportes',
            'Drama',
            'Familiar',
            'Fantasia',
            'Guerra',
            'Histórico',
            'Horror',
            'Misterio',
            'Musical',
            'Romance',
            'Reality Show',
            'Terror',
            'Thriller',
            'Western',
        );

        foreach($genders as $gender){
            $genres = new Gender();
            $genres->setName($gender);

            $manager->persist($genres);
        }

        $manager->flush();
    }
}
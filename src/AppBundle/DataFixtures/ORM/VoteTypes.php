<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\VoteType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class VoteTypes extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 40;
    }

    public function load(ObjectManager $manager)
    {
        $voteTypes = array(
            'Me ha encantado',
            'Me ha gustado',
            'No está mal',
            'No me ha gustado',
        );

        foreach ($voteTypes as $voteType) {
            $voteTypes = new VoteType();
            $voteTypes->setName($voteType);

            $manager->persist($voteTypes);
        }

        $manager->flush();
    }
}
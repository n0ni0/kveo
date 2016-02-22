<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 80;
    }

    public function load(ObjectManager $manager)
    {
        for($i=0; $i < 10; $i++) {
            $medias = $manager->getRepository('AppBundle:Media')->findAll();
            $users = $manager->getRepository('AppBundle:User')->findAll();
            $user = $users[array_rand($users)];
            $media = $medias[array_rand($medias)];

            $comment = new Comment();
            $comment->setMedia($media);
            $comment->setUser($user);
            $comment->setComment($this->getComments());
            $manager->persist($comment);
        }

        $manager->flush();
    }

    private function getComments()
    {
        $comments = array(
            'Insuperable',
            'Más de lo mismo',
            'Para el presupuesto que tenían no selo han currado',
            'Me ha impresionado el final',
            'Increible',
            'Me rei mucho, lo que pasa es que llevaba semanas oyendo que era
            tantantantan buena que al final no me pareció para tanto, pero bueno si es verdad que te ríes un montón.'
        );

        return $comments[array_rand($comments)];
    }
}
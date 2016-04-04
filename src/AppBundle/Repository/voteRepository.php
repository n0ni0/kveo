<?php

namespace AppBundle\Repository;

/**
 * voteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VoteRepository extends \Doctrine\ORM\EntityRepository
{
    public function findMediaTrends()
    {
        $em  = $this->getEntityManager();
        $dql = 'SELECT m.title, m.slug, m.img
                  FROM AppBundle:Vote v
                  JOIN v.media m
                 WHERE v.rating < 4';

        $query = $em->createQuery($dql);
        $query->execute();
        return $query->getResult();
    }
}

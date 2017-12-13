<?php

namespace AppBundle\Repository;

class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function getSinglePost(int $id)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()->getOneOrNullResult();
    }
}

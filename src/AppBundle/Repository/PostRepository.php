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

    public function countByYear()
    {
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare('SELECT YEAR(created_at), COUNT(*) FROM post p GROUP BY YEAR(created_at)');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    public function countByMonthInYear()
    {
        $quantity = $this->countByYear();
        $conn = $this->getEntityManager()->getConnection();

        foreach ($quantity as $year => &$value) {
            $stmt = $conn->prepare(
                'SELECT MONTH(created_at), COUNT(*) FROM post p WHERE YEAR(created_at) = :year GROUP BY MONTH(created_at)'
            );
            $stmt->bindValue(':year', $year);
            $stmt->execute();
            $value = $stmt->fetchAll(\PDO::FETCH_KEY_PAIR);
        }

        return $quantity;
    }

    public function countByCategory()
    {
        return $this->createQueryBuilder('p')
            ->select('c.slug, COUNT(p)')
            ->join('p.category', 'c')
            ->groupBy('c.slug')
            ->getQuery()->getResult();
    }
}

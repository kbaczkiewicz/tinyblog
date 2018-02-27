<?php

namespace AppBundle\Search;

use AppBundle\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class PostSearch
{
    private $postRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->postRepository = $entityManager->getRepository(Post::class);
    }

    public function countByYear()
    {
        return $this->postRepository->countByYear();
    }

    public function countByMonthInYear()
    {
        return $this->postRepository->countByMonthInYear();
    }

    public function countByCategory()
    {
        return $this->postRepository->countByCategory();
    }
}
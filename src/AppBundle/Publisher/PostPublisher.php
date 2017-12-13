<?php

namespace AppBundle\Publisher;

use AppBundle\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostPublisher
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * PostCreator constructor.
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     */
    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function publish(Post $post)
    {
        $this->validate($post);
        $this->persist($post);
    }

    private function validate(Post $post)
    {
        $errors = $this->validator->validate($post);
        if (count($errors) > 0) {
            throw new \InvalidArgumentException(sprintf("You must validate %s before %s!", get_class($post), __CLASS__));
        }
    }

    private function persist(Post $post)
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}

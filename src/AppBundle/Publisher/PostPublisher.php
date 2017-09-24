<?php

namespace AppBundle\Publisher;


use AppBundle\Entity\Background;
use AppBundle\Entity\Post;
use AppBundle\Model\Post as PostVO;
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
     * @var Post
     */
    private $poem;

    /**
     * @var Background
     */
    private $background;

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

    public function createFromValueObject(PostVO $poem)
    {
        $this->validate($poem);
        $this->createEntities($poem);
    }

    public function publish()
    {
        $this->persist();
    }

    private function createEntities(PostVO $poem)
    {
        $this->poem = new Post();
        $this->background = new Background();
        $poem->setAuthor($poem->getAuthor());
        $poem->setTitle($poem->getTitle());
        $poem->setCreatedAt($poem->getCreatedAt());
        $poem->setPost($poem->getPost());
        $this->background->setBackgroundColor($poem->getBackgroundColor());
        $this->background->setBackgroundImage($poem->getBackgroundImage());
        $this->background->setFontColor($poem->getFontColor());
        $this->poem->setBackground($this->background);
        $this->background->setPost($this->poem);
    }

    private function validate(PostVO $poem)
    {
        $errors = $this->validator->validate($poem);
        if (count($errors) > 0) {
            throw new \InvalidArgumentException(sprintf("You must validate %s before %s!", get_class($poem), __CLASS__));
        }
    }

    private function persist()
    {
        $this->entityManager->persist($this->poem);
        $this->entityManager->persist($this->background);
        $this->entityManager->flush();
    }
}

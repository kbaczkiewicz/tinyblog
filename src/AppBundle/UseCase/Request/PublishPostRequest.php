<?php


namespace AppBundle\UseCase\Request;

use AppBundle\Model\Post;

class PublishPostRequest implements UseCaseRequestInterface
{
    /**
     * @var Post
     */
    private $poem;

    public function __construct(Post $poem)
    {
        $this->poem = $poem;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->poem;
    }
}
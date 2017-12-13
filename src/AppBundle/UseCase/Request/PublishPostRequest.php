<?php

namespace AppBundle\UseCase\Request;

use \AppBundle\Entity\Post;

class PublishPostRequest implements UseCaseRequestInterface
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
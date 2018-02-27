<?php

namespace AppBundle\UseCase\Response;


use AppBundle\Entity\Post;

class SinglePostResponse implements UseCaseResponseInterface
{
    /**
     * @var Post
     */
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function toArray()
    {
        return [
            'post' => $this->post,
        ];
    }
}
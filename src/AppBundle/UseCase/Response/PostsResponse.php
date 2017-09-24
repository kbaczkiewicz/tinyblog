<?php

namespace AppBundle\UseCase\Response;


class PostsResponse implements UseCaseResponseInterface
{
    /**
     * @var array
     */
    private $posts;

    /**
     * PoemsResponse constructor.
     * @param array $poems
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    public function toArray()
    {
        return [
            'posts' => $this->posts,
        ];
    }


}
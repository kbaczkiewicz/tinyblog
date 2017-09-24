<?php

namespace AppBundle\UseCase\Response;


use AppBundle\Entity\Post;

class SinglePostResponse implements UseCaseResponseInterface
{
    /**
     * @var Post
     */
    private $poem;


    public function toArray()
    {
        return [
            'poem' => $this->poem,
        ];
    }
}
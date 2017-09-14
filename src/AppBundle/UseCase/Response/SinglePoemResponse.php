<?php

namespace AppBundle\UseCase\Response;


use AppBundle\Entity\Poem;

class SinglePoemResponse implements UseCaseResponseInterface
{
    /**
     * @var Poem
     */
    private $poem;


    public function toArray()
    {
        return [
            'poem' => $this->poem,
        ];
    }
}
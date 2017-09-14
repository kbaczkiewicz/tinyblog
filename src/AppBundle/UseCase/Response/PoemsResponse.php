<?php

namespace AppBundle\UseCase\Response;


class PoemsResponse implements UseCaseResponseInterface
{
    /**
     * @var array
     */
    private $poems;

    /**
     * PoemsResponse constructor.
     * @param array $poems
     */
    public function __construct(array $poems)
    {
        $this->poems = $poems;
    }

    public function toArray()
    {
        return [
            'poems' => $this->poems,
        ];
    }


}
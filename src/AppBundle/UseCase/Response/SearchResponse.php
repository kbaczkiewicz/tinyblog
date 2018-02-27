<?php

namespace AppBundle\UseCase\Response;

class SearchResponse implements UseCaseResponseInterface
{
    private $criteria;

    public function toArray()
    {
        return $this->criteria;
    }
}
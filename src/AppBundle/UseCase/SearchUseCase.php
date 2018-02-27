<?php

namespace AppBundle\UseCase;

use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\UseCase\Request\SearchRequest;
use AppBundle\UseCase\Request\UseCaseRequestInterface;
use AppBundle\UseCase\Response\UseCaseResponseInterface;

class SearchUseCase implements UseCaseInterface
{

    function execute(UseCaseRequestInterface $request): UseCaseResponseInterface
    {
        $this->validateRequestType($request);
    }

    function validateRequestType(UseCaseRequestInterface $request)
    {
        if (!($request instanceof SearchRequest)) {
            throw new InvalidUseCaseRequestException();
        }
    }
}
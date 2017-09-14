<?php
namespace AppBundle\UseCase;


use AppBundle\UseCase\Request\UseCaseRequestInterface;
use AppBundle\UseCase\Response\UseCaseResponseInterface;

interface UseCaseInterface
{
    function execute(UseCaseRequestInterface $request): UseCaseResponseInterface;
    function validateRequestType(UseCaseRequestInterface $request);
}
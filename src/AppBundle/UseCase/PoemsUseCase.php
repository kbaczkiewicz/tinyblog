<?php

namespace AppBundle\UseCase;


use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\UseCase\Request\PoemsRequest;
use AppBundle\UseCase\Request\UseCaseRequestInterface;
use AppBundle\UseCase\Response\PoemsResponse;
use AppBundle\UseCase\Response\UseCaseResponseInterface;
use Doctrine\ORM\EntityManagerInterface;

class PoemsUseCase
{
    private $poemRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->poemRepository = $entityManager->getRepository('AppBundle:Poem');
    }

    public function execute(UseCaseRequestInterface  $request): UseCaseResponseInterface
    {
        $this->validateRequestType($request);

        return new PoemsResponse($this->poemRepository->findAll());
    }

    private function validateRequestType(UseCaseRequestInterface $request)
    {
        if(!$request instanceof PoemsRequest) {
            throw new InvalidUseCaseRequestException();
        }
    }
}
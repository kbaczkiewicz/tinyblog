<?php

namespace AppBundle\UseCase;


use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\UseCase\Request\PostsRequest;
use AppBundle\UseCase\Request\UseCaseRequestInterface;
use AppBundle\UseCase\Response\PostsResponse;
use AppBundle\UseCase\Response\UseCaseResponseInterface;
use Doctrine\ORM\EntityManagerInterface;

class PostsUseCase
{
    private $poemRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->poemRepository = $entityManager->getRepository('AppBundle:Post');
    }

    public function execute(UseCaseRequestInterface  $request): UseCaseResponseInterface
    {
        $this->validateRequestType($request);

        return new PostsResponse($this->poemRepository->findAll());
    }

    private function validateRequestType(UseCaseRequestInterface $request)
    {
        if(!$request instanceof PostsRequest) {
            throw new InvalidUseCaseRequestException();
        }
    }
}
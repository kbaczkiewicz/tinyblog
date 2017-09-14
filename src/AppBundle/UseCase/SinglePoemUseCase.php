<?php

namespace AppBundle\UseCase;


use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\Repository\PoemRepository;
use AppBundle\UseCase\Request\SinglePoemRequest;
use AppBundle\UseCase\Request\UseCaseRequestInterface;
use AppBundle\UseCase\Response\SinglePoemResponse;
use AppBundle\UseCase\Response\UseCaseResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SinglePoemUseCase implements UseCaseInterface
{
    /**
     * @var PoemRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository('AppBundle:Poem');
    }

    public function execute(UseCaseRequestInterface $request): UseCaseResponseInterface
    {
        $this->validateRequestType($request);
        $poem = $this->getPoem($request->getId());
        return new SinglePoemResponse($poem);
    }

    public function validateRequestType(UseCaseRequestInterface $request)
    {
        if(!$request instanceof SinglePoemRequest) {
            throw new InvalidUseCaseRequestException();
        }
    }

    private function getPoem(int $id)
    {
        $poem = $this->repository->getSinglePoem($id);
        if(null === $poem) {
            throw new NotFoundHttpException("There is no poem for given ID");
        }

        return $poem;
    }
}
<?php

namespace AppBundle\UseCase;


use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\Repository\PostRepository;
use AppBundle\UseCase\Request\SinglePostRequest;
use AppBundle\UseCase\Request\UseCaseRequestInterface;
use AppBundle\UseCase\Response\SinglePostResponse;
use AppBundle\UseCase\Response\UseCaseResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SinglePostUseCase implements UseCaseInterface
{
    /**
     * @var PostRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository('AppBundle:Post');
    }

    public function execute(UseCaseRequestInterface $request): UseCaseResponseInterface
    {
        $this->validateRequestType($request);
        $poem = $this->getPost($request->getId());
        return new SinglePostResponse($poem);
    }

    public function validateRequestType(UseCaseRequestInterface $request)
    {
        if(!$request instanceof SinglePostRequest) {
            throw new InvalidUseCaseRequestException();
        }
    }

    private function getPost(int $id)
    {
        $poem = $this->repository->getSinglePost($id);
        if(null === $poem) {
            throw new NotFoundHttpException("There is no poem for given ID");
        }

        return $poem;
    }
}
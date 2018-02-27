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
        $post = $this->getPost($request->getId());

        return new SinglePostResponse($post);
    }

    public function validateRequestType(UseCaseRequestInterface $request)
    {
        if (!$request instanceof SinglePostRequest) {
            throw new InvalidUseCaseRequestException();
        }
    }

    private function getPost(int $id)
    {
        $post = $this->repository->getSinglePost($id);
        if (null === $post) {
            throw new NotFoundHttpException("There is no post for given ID");
        }

        return $post;
    }
}
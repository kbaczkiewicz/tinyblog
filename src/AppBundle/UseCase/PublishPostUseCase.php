<?php

namespace AppBundle\UseCase;


use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\Publisher\PostPublisher;
use AppBundle\UseCase\Request\PublishPostRequest;
use AppBundle\UseCase\Request\UseCaseRequestInterface;
use AppBundle\UseCase\Response\PublishPostResponse;
use AppBundle\UseCase\Response\UseCaseResponseInterface;

class PublishPostUseCase implements UseCaseInterface
{
    private $postPublisher;

    public function __construct(PostPublisher $postPublisher)
    {
        $this->postPublisher = $postPublisher;
    }

    public function execute(UseCaseRequestInterface $request): UseCaseResponseInterface
    {
        $this->validateRequestType($request);
        try {
            $this->postPublisher->publish($request->getPost());
            return new PublishPostResponse('Post published succesfully');
        } catch (\InvalidArgumentException $ex) {
            return new PublishPostResponse($ex->getMessage());
        }
    }

    public function validateRequestType(UseCaseRequestInterface $request)
    {
        if (!$request instanceof PublishPostRequest) {
            throw new InvalidUseCaseRequestException();
        }
    }
}
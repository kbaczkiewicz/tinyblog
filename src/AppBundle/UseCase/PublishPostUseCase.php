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
    /**
     * @var PoemPublisher
     */
    private $poemPublisher;

    /**
     * PublishPoemUseCase constructor.
     * @param PoemPublisher $poemPublisher
     * @todo - translation
     */
    public function __construct(PostPublisher $poemPublisher)
    {
        $this->poemPublisher = $poemPublisher;
    }

    public function execute(UseCaseRequestInterface $request): UseCaseResponseInterface
    {
        $this->validateRequestType($request);
        try {
            $this->poemPublisher->createFromValueObject($request->getPost());
            $this->poemPublisher->publish();
            return new PublishPostResponse('Poem published succesfully');
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
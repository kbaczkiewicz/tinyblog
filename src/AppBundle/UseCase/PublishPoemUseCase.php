<?php

namespace AppBundle\UseCase;


use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\Publisher\PoemPublisher;
use AppBundle\UseCase\Request\PublishPoemRequest;
use AppBundle\UseCase\Request\UseCaseRequestInterface;
use AppBundle\UseCase\Response\PublishPoemResponse;
use AppBundle\UseCase\Response\UseCaseResponseInterface;

class PublishPoemUseCase implements UseCaseInterface
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
    public function __construct(PoemPublisher $poemPublisher)
    {
        $this->poemPublisher = $poemPublisher;
    }

    public function execute(UseCaseRequestInterface $request): UseCaseResponseInterface
    {
        $this->validateRequestType($request);
        try {
            $this->poemPublisher->createFromValueObject($request->getPoem());
            $this->poemPublisher->publish();
            return new PublishPoemResponse('Poem published succesfully');
        } catch (\InvalidArgumentException $ex) {
            return new PublishPoemResponse($ex->getMessage());
        }
    }

    public function validateRequestType(UseCaseRequestInterface $request)
    {
        if (!$request instanceof PublishPoemRequest) {
            throw new InvalidUseCaseRequestException();
        }
    }
}
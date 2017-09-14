<?php

namespace unit\AppBundle\UseCase;

use AppBundle\Model\Poem;
use AppBundle\Publisher\PoemPublisher;
use AppBundle\UseCase\PublishPoemUseCase;
use AppBundle\UseCase\Request\PoemsRequest;
use AppBundle\UseCase\Request\PublishPoemRequest;
use AppBundle\UseCase\Response\PublishPoemResponse;
use Codeception\Test\Unit;

class PublishPoemUseCaseTest extends Unit
{
    /**
     * @var PublishPoemUseCase
     */
    private $useCase;

    protected function _before()
    {
        $this->useCase = new PublishPoemUseCase($this->getPoemPublisher());
    }

    protected function _after()
    {

    }

    public function testReturnsResponseOnValidRequest()
    {
        $request = new PublishPoemRequest(new Poem());
        $response = $this->useCase->execute($request);
        $this->assertTrue($response instanceof PublishPoemResponse);
    }

    /**
     * @expectedException \AppBundle\Exception\InvalidUseCaseRequestException
     */
    public function testThrowsExceptionOnInvalidRequest()
    {
        $request = new PoemsRequest();
        $this->useCase->execute($request);
    }


    private function getPoemPublisher()
    {
        return \Mockery::mock(PoemPublisher::class)->shouldIgnoreMissing();
    }
}
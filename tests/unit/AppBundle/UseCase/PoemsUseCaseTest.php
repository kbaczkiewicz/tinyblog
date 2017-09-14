<?php

namespace unit\AppBundle\UseCase;


use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\Repository\PoemRepository;
use AppBundle\UseCase\PoemsUseCase;
use AppBundle\UseCase\Request\PoemsRequest;
use AppBundle\UseCase\Request\SinglePoemRequest;
use AppBundle\UseCase\Response\PoemsResponse;
use Codeception\Test\Unit;
use Doctrine\ORM\EntityManagerInterface;

class PoemsUseCaseTest extends Unit
{
    /**
     * @var PoemsUseCase
     */
    private $useCase;

    protected function _before()
    {
        $this->useCase = new PoemsUseCase($this->getEntityManager());
        $this->tearDown();
    }

    public function testValidRequestReturnsValidResponse()
    {
        $request = new PoemsRequest();
        $response = $this->useCase->execute($request);
        $this->assertTrue($response instanceof PoemsResponse);
    }

    /**
     * @expectedException \AppBundle\Exception\InvalidUseCaseRequestException
     */
    public function testThrowsExceptionOnInvalidRequest()
    {
        $request = new SinglePoemRequest(1);
        $this->useCase->execute($request);
    }

    protected function _after()
    {
    }

    private function getEntityManager()
    {
        return \Mockery::mock(EntityManagerInterface::class)
            ->shouldReceive('getRepository')
            ->with('AppBundle:Poem')
            ->andReturn($this->getRepository())
            ->getMock();
    }

    private function getRepository()
    {
        return \Mockery::mock(PoemRepository::class)
            ->shouldReceive('findAll')
            ->andReturn(array())
            ->getMock();
    }
}
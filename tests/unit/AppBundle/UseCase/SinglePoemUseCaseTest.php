<?php

namespace unit\AppBundle\UseCase;


use AppBundle\Entity\Poem;
use AppBundle\Repository\PoemRepository;
use AppBundle\UseCase\PoemsUseCase;
use AppBundle\UseCase\Request\PoemsRequest;
use AppBundle\UseCase\Request\SinglePoemRequest;
use AppBundle\UseCase\Response\SinglePoemResponse;
use AppBundle\UseCase\SinglePoemUseCase;
use Codeception\Test\Unit;
use Doctrine\ORM\EntityManagerInterface;

class SinglePoemUseCaseTest extends Unit
{
    /**
     * @var SinglePoemUseCase
     */
    private $validUseCase;

    /**
     * @var SinglePoemUseCase
     */
    private $invalidUseCase;

    protected function _before()
    {
        $this->validUseCase = new SinglePoemUseCase($this->getEntityManager($this->getValidRepository()));
        $this->invalidUseCase = new SinglePoemUseCase($this->getEntityManager($this->getInvalidRepository()));
        $this->tearDown();
    }

    public function testValidRequestReturnsResponse()
    {
        $request = new SinglePoemRequest(1);
        $response = $this->validUseCase->execute($request);
        $this->assertTrue($response instanceof SinglePoemResponse);
    }

    /**
     * @expectedException \AppBundle\Exception\InvalidUseCaseRequestException
     */
    public function testThrowsExceptionOnInvalidRequest()
    {
        $request = new PoemsRequest();
        $this->validUseCase->execute($request);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testThrowsNotFoundExceptionIfNoItemFound()
    {
        $request = new SinglePoemRequest(1);
        $this->invalidUseCase->execute($request);
    }

    protected function _after()
    {
    }

    private function getEntityManager($repository)
    {
        return \Mockery::mock(EntityManagerInterface::class)
            ->shouldReceive('getRepository')
            ->with('AppBundle:Poem')
            ->andReturn($repository)
            ->getMock();
    }

    private function getInvalidRepository()
    {
        return $this->getRepository(null);
    }

    private function getValidRepository()
    {
        return $this->getRepository(new Poem);
    }

    private function getRepository($return)
    {
        return \Mockery::mock(PoemRepository::class)
            ->shouldReceive('getSinglePoem')
            ->with(1)
            ->andReturn($return)
            ->getMock();
    }
}
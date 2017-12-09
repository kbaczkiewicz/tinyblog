<?php

use AppBundle\Exception\InvalidUseCaseRequestException;
use AppBundle\Repository\PostRepository;
use AppBundle\UseCase\PostsUseCase;
use AppBundle\UseCase\Request\PostsRequest;
use AppBundle\UseCase\Request\SinglePostRequest;
use AppBundle\UseCase\Response\PostsResponse;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class PostsUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PostsUseCase
     */
    private $useCase;

    protected function setUp()
    {
        $this->useCase = new PostsUseCase($this->getEntityManager());
        $this->tearDown();
    }

    public function testValidRequestReturnsValidResponse()
    {
        $request = new PostsRequest();
        $response = $this->useCase->execute($request);
        $this->assertTrue($response instanceof PostsResponse);
    }

    /**
     * @expectedException \AppBundle\Exception\InvalidUseCaseRequestException
     */
    public function testThrowsExceptionOnInvalidRequest()
    {
        $request = new SinglePostRequest(1);
        $this->useCase->execute($request);
    }

    private function getEntityManager()
    {
        return \Mockery::mock(EntityManagerInterface::class)
            ->shouldReceive('getRepository')
            ->with('AppBundle:Post')
            ->andReturn($this->getRepository())
            ->getMock();
    }

    private function getRepository()
    {
        return \Mockery::mock(PostRepository::class)
            ->shouldReceive('findAll')
            ->andReturn(array())
            ->getMock();
    }
}
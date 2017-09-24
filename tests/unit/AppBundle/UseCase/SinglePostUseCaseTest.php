<?php

namespace unit\AppBundle\UseCase;


use AppBundle\Entity\Post;
use AppBundle\Repository\PostRepository;
use AppBundle\UseCase\PostsUseCase;
use AppBundle\UseCase\Request\PostsRequest;
use AppBundle\UseCase\Request\SinglePostRequest;
use AppBundle\UseCase\Response\SinglePostResponse;
use AppBundle\UseCase\SinglePostUseCase;
use Codeception\Test\Unit;
use Doctrine\ORM\EntityManagerInterface;

class SinglePostUseCaseTest extends Unit
{
    /**
     * @var SinglePostUseCase
     */
    private $validUseCase;

    /**
     * @var SinglePostUseCase
     */
    private $invalidUseCase;

    protected function _before()
    {
        $this->validUseCase = new SinglePostUseCase($this->getEntityManager($this->getValidRepository()));
        $this->invalidUseCase = new SinglePostUseCase($this->getEntityManager($this->getInvalidRepository()));
        $this->tearDown();
    }

    public function testValidRequestReturnsResponse()
    {
        $request = new SinglePostRequest(1);
        $response = $this->validUseCase->execute($request);
        $this->assertTrue($response instanceof SinglePostResponse);
    }

    /**
     * @expectedException \AppBundle\Exception\InvalidUseCaseRequestException
     */
    public function testThrowsExceptionOnInvalidRequest()
    {
        $request = new PostsRequest();
        $this->validUseCase->execute($request);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testThrowsNotFoundExceptionIfNoItemFound()
    {
        $request = new SinglePostRequest(1);
        $this->invalidUseCase->execute($request);
    }

    protected function _after()
    {
    }

    private function getEntityManager($repository)
    {
        return \Mockery::mock(EntityManagerInterface::class)
            ->shouldReceive('getRepository')
            ->with('AppBundle:Post')
            ->andReturn($repository)
            ->getMock();
    }

    private function getInvalidRepository()
    {
        return $this->getRepository(null);
    }

    private function getValidRepository()
    {
        return $this->getRepository(new Post);
    }

    private function getRepository($return)
    {
        return \Mockery::mock(PostRepository::class)
            ->shouldReceive('getSinglePost')
            ->with(1)
            ->andReturn($return)
            ->getMock();
    }
}
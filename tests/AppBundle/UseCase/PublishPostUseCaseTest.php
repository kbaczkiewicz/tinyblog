<?php

use AppBundle\Model\Post;
use AppBundle\Publisher\PostPublisher;
use AppBundle\UseCase\PublishPostUseCase;
use AppBundle\UseCase\Request\PostsRequest;
use AppBundle\UseCase\Request\PublishPostRequest;
use AppBundle\UseCase\Response\PublishPostResponse;
use Doctrine\Bundle\DoctrineCacheBundle\Tests\TestCase;

class PublishPostUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PublishPostUseCase
     */
    private $useCase;

    protected function setUp()
    {
        $this->useCase = new PublishPostUseCase($this->getPostPublisher());
    }

    protected function _after()
    {

    }

    public function testReturnsResponseOnValidRequest()
    {
        $request = new PublishPostRequest(new Post());
        $response = $this->useCase->execute($request);
        $this->assertTrue($response instanceof PublishPostResponse);
    }

    /**
     * @expectedException \AppBundle\Exception\InvalidUseCaseRequestException
     */
    public function testThrowsExceptionOnInvalidRequest()
    {
        $request = new PostsRequest();
        $this->useCase->execute($request);
    }


    private function getPostPublisher()
    {
        return \Mockery::mock(PostPublisher::class)->shouldIgnoreMissing();
    }
}
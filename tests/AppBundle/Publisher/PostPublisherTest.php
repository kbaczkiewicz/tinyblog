<?php

use AppBundle\Model\Post;
use AppBundle\Publisher\PostPublisher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class PostPublisherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PostPublisher
     */
    private $validPostPublisher;

    /**
     * @var PostPublisher
     */
    private $invalidPostPublisher;

    protected function setUp()
    {
        $this->validPostPublisher = new PostPublisher($this->getEntityManager(), $this->getValidValidator());
        $this->invalidPostPublisher = new PostPublisher($this->getEntityManager(), $this->getInvalidValidator());
        $this->tearDown();
    }

    protected function _after()
    {

    }

    public function testPublishPostOnValidData()
    {
        $this->assertEmpty($this->validPostPublisher->createFromValueObject($this->getPost()));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnInvalidData()
    {
        $this->invalidPostPublisher->createFromValueObject($this->getPost());
    }


    private function getEntityManager()
    {
        $mock = \Mockery::mock(EntityManagerInterface::class)
            ->shouldReceive('persist')
            ->with($this->getPost())
            ->andReturn(null)
            ->getMock();

        $mock->shouldReceive('flush')
            ->andReturnNull()
            ->getMock();

        return $mock;
    }


    private function getValidValidator()
    {
        return $this->getValidator([]);
    }

    private function getInvalidValidator()
    {
        return $this->getValidator(['Foo constraint']);
    }

    private function getValidator($errors)
    {
        return \Mockery::mock(ValidatorInterface::class)
            ->shouldReceive('validate')
            ->with(Post::class)
            ->andReturn($errors)
            ->getMock();
    }

    public function getPost()
    {
        return new Post();
    }
}
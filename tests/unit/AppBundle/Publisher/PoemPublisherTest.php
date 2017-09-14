<?php
/**
 * Created by PhpStorm.
 * User: celtic
 * Date: 13.09.17
 * Time: 21:52
 */

namespace unit\AppBundle\Publisher;


use AppBundle\Model\Poem;
use AppBundle\Publisher\PoemPublisher;
use Codeception\Test\Unit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PoemPublisherTest extends Unit
{
    /**
     * @var PoemPublisher
     */
    private $validPoemPublisher;

    /**
     * @var PoemPublisher
     */
    private $invalidPoemPublisher;

    protected function _before()
    {
        $this->validPoemPublisher = new PoemPublisher($this->getEntityManager(), $this->getValidValidator());
        $this->invalidPoemPublisher = new PoemPublisher($this->getEntityManager(), $this->getInvalidValidator());
        $this->tearDown();
    }

    protected function _after()
    {

    }

    public function testPublishPoemOnValidData()
    {
        $this->assertEmpty($this->validPoemPublisher->createFromValueObject($this->getPoem()));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnInvalidData()
    {
        $this->invalidPoemPublisher->createFromValueObject($this->getPoem());
    }


    private function getEntityManager()
    {
        $mock = \Mockery::mock(EntityManagerInterface::class)
            ->shouldReceive('persist')
            ->with($this->getPoem())
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
            ->with(Poem::class)
            ->andReturn($errors)
            ->getMock();
    }

    public function getPoem()
    {
        return new Poem();
    }
}
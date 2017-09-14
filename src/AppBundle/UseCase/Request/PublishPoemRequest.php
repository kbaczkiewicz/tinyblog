<?php
/**
 * Created by PhpStorm.
 * User: celtic
 * Date: 13.09.17
 * Time: 20:57
 */

namespace AppBundle\UseCase\Request;

use AppBundle\Model\Poem;

class PublishPoemRequest implements UseCaseRequestInterface
{
    /**
     * @var Poem
     */
    private $poem;

    public function __construct(Poem $poem)
    {
        $this->poem = $poem;
    }

    /**
     * @return Poem
     */
    public function getPoem(): Poem
    {
        return $this->poem;
    }
}
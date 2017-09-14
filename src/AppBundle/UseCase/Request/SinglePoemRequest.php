<?php
/**
 * Created by PhpStorm.
 * User: celtic
 * Date: 13.09.17
 * Time: 18:57
 */

namespace AppBundle\UseCase\Request;


class SinglePoemRequest implements UseCaseRequestInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * SinglePoemRequest constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
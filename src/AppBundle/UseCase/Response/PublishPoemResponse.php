<?php

namespace AppBundle\UseCase\Response;

class PublishPoemResponse implements UseCaseResponseInterface
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }
    public function toArray()
    {
        return [
            'message' => $this->message,
        ];
    }
}

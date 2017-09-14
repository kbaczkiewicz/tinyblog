<?php
/**
 * Created by PhpStorm.
 * User: celtic
 * Date: 13.09.17
 * Time: 18:51
 */

namespace AppBundle\Exception;


use Exception;

class InvalidUseCaseRequestException extends \Exception
{
    public function __construct(
        $message = "Invalid request supplied for this UseCase",
        $code = 400,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: celtic
 * Date: 13.09.17
 * Time: 21:08
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class ImageOrColorIsSet extends Constraint
{
    public $message = "Either image or background must be set";

    public function validatedBy()
    {
        return ImageOrColorIsSetValidator::class;
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
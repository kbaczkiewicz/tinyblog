<?php
/**
 * Created by PhpStorm.
 * User: celtic
 * Date: 13.09.17
 * Time: 21:10
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ImageOrColorIsSetValidator extends ConstraintValidator
{

    /**
     * @inheritdoc
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value->getBackgroundColor() && null === $value->getBackgroundImage()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
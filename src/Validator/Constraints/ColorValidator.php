<?php

namespace App\Validator\Constraints;

use App\Entity\ProductInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ColorValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Color) {
            throw new UnexpectedTypeException($constraint, Color::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $allowedColors = [
            ProductInterface::COLOR_RED,
            ProductInterface::COLOR_GREEN,
            ProductInterface::COLOR_BLUE,
            ProductInterface::COLOR_YELLOW,
            ProductInterface::COLOR_PURPLE,
        ];

        if (!in_array(strtolower($value), $allowedColors, true)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}

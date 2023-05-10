<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class Color extends Constraint
{
    public $message = 'Please enter a valid color (letters only).';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
}

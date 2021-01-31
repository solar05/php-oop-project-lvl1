<?php

namespace Validator;

use Validator\Validators\NumberValidator;
use Validator\Validators\StringValidator;

class Validator
{

    public function string(): StringValidator
    {
        return new StringValidator();
    }

    public function number(): NumberValidator
    {
        return new NumberValidator();
    }
}

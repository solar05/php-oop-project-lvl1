<?php

namespace Validator;

use Validator\Validators\ArrayValidator;
use Validator\Validators\NumberValidator;
use Validator\Validators\StringValidator;

class Validator
{
    protected mixed $customValidations = [
        'number' => [],
        'string' => []
    ];

    public function string(): StringValidator
    {
        return new StringValidator($this->customValidations['string']);
    }

    public function number(): NumberValidator
    {
        return new NumberValidator($this->customValidations['number']);
    }

    public function array(): ArrayValidator
    {
        return new ArrayValidator();
    }

    public function addValidator(string $validator, string $name, callable $fn): Validator
    {
        $this->customValidations[$validator][$name] = $fn;
        return $this;
    }
}

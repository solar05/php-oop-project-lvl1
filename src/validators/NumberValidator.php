<?php

namespace Hexlet\Validator\Validators;

class NumberValidator extends AbstractValidator
{
    public function __construct(mixed $validations = [])
    {
        $this->validations['default'] = fn($number) => is_numeric($number);
        $this->customValidations = $validations;
    }

    public function range(int $min, int $max): NumberValidator
    {
        $this->validations['range'] = fn($number) => !($number < $min || $number > $max);
        return $this;
    }

    public function positive(): NumberValidator
    {
        $this->validations['positive'] = fn($number) => $number == null ? true : $number > 0;
        return $this;
    }
}

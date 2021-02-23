<?php

namespace Hexlet\Validator\Validators;

class StringValidator extends AbstractValidator
{
    public function __construct(mixed $validations = [])
    {
        $this->validations['required'] = fn($str) => is_string($str);
        $this->customValidations = $validations;
    }

    public function required(): StringValidator
    {
        $this->nullable = false;
        $this->validations['required'] = fn($str) => $str !== '';
        return $this;
    }

    public function contains(string $string = ''): StringValidator
    {
        $this->validations['contains'] = fn($str) => str_contains($str, $string);
        return $this;
    }

    public function minLength(int $length): StringValidator
    {
        $this->validations['minLength'] = fn($str) => strlen($str) >= $length;
        return $this;
    }
}

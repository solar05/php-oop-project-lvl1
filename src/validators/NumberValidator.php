<?php

namespace Hexlet\Validator\Validators;

class NumberValidator
{
    protected mixed $customValidations = [];
    protected mixed $validations = [];

    public function __construct(mixed $validations = [])
    {
        $this->validations['default'] = fn($number) => $number == null || is_integer($number);
        $this->customValidations = $validations;
    }

    public function isValid(mixed $number): bool
    {
        foreach ($this->validations as $validation) {
            if (!$validation($number)) {
                return false;
            }
        }
        return true;
    }

    public function required(): NumberValidator
    {
        $this->validations['required'] = fn($number) => is_integer($number);
        return $this;
    }

    public function range(int $min, int $max): NumberValidator
    {
        $this->validations['range'] = fn($number) => !($number < $min || $number > $max);
        return $this;
    }

    public function positive(): NumberValidator
    {
        $this->validations['positive'] = fn($number) => $number >= 0;
        return $this;
    }

    public function test(string $name, int $value): NumberValidator
    {
        if (array_key_exists($name, $this->customValidations)) {
            $fn = $this->customValidations[$name];
            $this->validations[$name] = fn($num) => $fn($num, $value);
        }
        return $this;
    }
}

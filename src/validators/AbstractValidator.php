<?php

namespace Hexlet\Validator\Validators;

abstract class AbstractValidator
{
    protected mixed $customValidations = [];
    protected mixed $validations = [];

    public function isValid(mixed $value): bool
    {
        foreach ($this->validations as $validation) {
            if (!$validation($value)) {
                return false;
            }
        }
        return true;
    }

    public function test(string $name, mixed $value): mixed
    {
        if (array_key_exists($name, $this->customValidations)) {
            $fn = $this->customValidations[$name];
            $this->validations[$name] = fn($checkValue) => $fn($checkValue, $value);
        }
        return $this;
    }
}

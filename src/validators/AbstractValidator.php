<?php

namespace Hexlet\Validator\Validators;

abstract class AbstractValidator
{
    protected mixed $customValidations = [];
    protected mixed $validations = [];
    protected bool $nullable = true;

    public function isValid(mixed $value): bool
    {
        if ($this->nullable && is_null($value)) {
            return true;
        }

        foreach ($this->validations as $validation) {
            if (!$validation($value)) {
                return false;
            }
        }
        return true;
    }

    public function required(): mixed
    {
        $this->nullable = false;
        return $this;
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

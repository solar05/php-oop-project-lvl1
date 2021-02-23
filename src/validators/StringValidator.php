<?php

namespace Hexlet\Validator\Validators;

class StringValidator
{
    protected mixed $customValidations = [];
    protected mixed $validations = [];

    public function __construct(mixed $validations = [])
    {
        $this->validations['default'] = fn($str) => is_string($str);
        $this->customValidations = $validations;
    }

    public function contains(string $string = ''): StringValidator
    {
        $this->validations['contains'] = fn($str) => str_contains($str, $string);
        return $this;
    }

    public function isValid(mixed $str): bool
    {
        foreach ($this->validations as $validation) {
            if (!$validation($str)) {
                return false;
            }
        }
        return true;
    }

    public function required(): StringValidator
    {
        $this->validations['required'] = fn($str) => is_string($str) && $str !== '';
        return $this;
    }

    public function test(string $name, string $value): StringValidator
    {
        if (array_key_exists($name, $this->customValidations)) {
            $fn = $this->customValidations[$name];
            $this->validations[$name] = fn($string) => $fn($string, $value);
        }
        return $this;
    }

    public function minLength(int $length): StringValidator
    {
        $this->validations['minLength'] = fn($str) => strlen($str) >= $length;
        return $this;
    }
}

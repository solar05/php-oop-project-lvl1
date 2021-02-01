<?php

namespace Hexlet\Validator\Validators;

class StringValidator
{
    protected string $str = "";
    protected bool $required = false;
    protected int $length = 0;
    protected mixed $customValidations = [];
    protected mixed $activatedValidations = [];

    public function __construct(mixed $validations = [])
    {
        $this->customValidations = $validations;
    }

    public function contains(string $str = ''): StringValidator
    {
        $this->str = $str;
        return $this;
    }

    public function isValid(mixed $str): bool
    {
        if (!is_string($str)) {
            return false;
        }
        if ($this->required) {
            return $str != '' ? str_contains($str, $this->str) : false;
        }
        if ($this->length != 0) {
            return strlen($str) >= $this->length;
        }
        if (count($this->activatedValidations) > 0) {
            $result = [];
            foreach ($this->activatedValidations as $validation) {
                if (!$validation($str)) {
                    $result[] = false;
                }
            }
            return count($result) === 0;
        }
        return str_contains($str, $this->str);
    }

    public function required(): StringValidator
    {
        $this->required = true;
        return $this;
    }

    public function test(string $name, string $value): StringValidator
    {
        if (array_key_exists($name, $this->customValidations)) {
            $fn = $this->customValidations[$name];
            $this->activatedValidations[$name] = fn($string) => $fn($string, $value);
        }
        return $this;
    }

    public function minLength(int $length): StringValidator
    {
        $this->length = $length;
        return $this;
    }
}

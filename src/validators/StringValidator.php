<?php

namespace Validator\Validators;

class StringValidator
{
    protected string $str = "";
    protected bool $required = false;
    protected int $length = 0;

    public function contains(string $str = ''): StringValidator
    {
        $this->str = $str;
        return $this;
    }

    public function isValid(mixed $str): bool
    {
        if (
            !is_string($str)
            || ($this->required && $this->str == '')
            || (strlen($str) < $this->length)
        ) {
            return false;
        }
        return str_contains($str, $this->str);
    }

    public function required(): StringValidator
    {
        $this->required = true;
        return $this;
    }

    public function minLength(int $length): StringValidator
    {
        $this->length = $length;
        return $this;
    }
}

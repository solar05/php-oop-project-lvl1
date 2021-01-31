<?php

namespace Validator\Validators;

class StringValidator
{
    protected string $str = "";
    protected bool $required = false;

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
}

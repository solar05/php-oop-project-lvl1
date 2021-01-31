<?php

namespace Validator\Validators;

class ArrayValidator
{
    protected bool $required = false;

    public function isValid(mixed $arr): bool
    {
        return is_array($arr);
    }

    public function required(): ArrayValidator
    {
        $this->required = true;
        return $this;
    }
}

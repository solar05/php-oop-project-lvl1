<?php

namespace Hexlet\Validator\Validators;

class ArrayValidator extends AbstractValidator
{
    public function isValid(mixed $arr): bool
    {
        foreach ($this->validations as $validation) {
            if (!$validation($arr)) {
                return false;
            }
        }
        return true;
    }

    public function required(): ArrayValidator
    {
        $this->validations['required'] = fn($arr) => is_array($arr);
        return $this;
    }

    public function shape(mixed $validators): ArrayValidator
    {
        $this->validations['shape'] = function ($shape) use ($validators) {
            foreach ($shape as $name => $val) {
                if (!$validators[$name]->isValid($val)) {
                    return false;
                }
            }
            return true;
        };
        return $this;
    }

    public function sizeof(int $length): ArrayValidator
    {
        $this->validations['size'] = fn($arr) => count($arr) >= $length;
        return $this;
    }
}

<?php

namespace Hexlet\Validator\Validators;

class ArrayValidator extends AbstractValidator
{
    public function __construct()
    {
        $this->validations['default'] = fn($arr) => is_array($arr);
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

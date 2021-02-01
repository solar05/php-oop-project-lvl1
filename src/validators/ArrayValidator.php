<?php

namespace Hexlet\Validator\Validators;

class ArrayValidator
{
    protected bool $required = false;
    protected mixed $shape = [];
    protected int $length = 0;

    public function isValid(mixed $arr): bool
    {
        if (!empty($this->shape)) {
            $result = [];
            foreach ($arr as $name => $val) {
                if (!$this->shape[$name]->isValid($val)) {
                    $result[] = false;
                }
            }
            return empty($result);
        }
        if ($this->length != 0 && array_key_exists(0, $arr)) {
            return strlen($arr[0]) >= $this->length;
        }
        if ($this->required) {
            return is_array($arr);
        }
        return true;
    }

    public function required(): ArrayValidator
    {
        $this->required = true;
        return $this;
    }

    public function shape(mixed $validators): ArrayValidator
    {
        $this->shape = $validators;
        return $this;
    }

    public function sizeof(int $length): ArrayValidator
    {
        $this->length = $length;
        return $this;
    }
}

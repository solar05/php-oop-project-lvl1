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
        if ($this->length != 0) {
            if (!empty($arr)) {
                $result = [];
                foreach ($arr as $val) {
                    if (strlen($val) <= $this->length) {
                        $result[] = false;
                    }
                }
                return empty($result);
            } else {
                return false;
            }
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

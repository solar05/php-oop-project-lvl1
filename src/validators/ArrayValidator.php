<?php

namespace Validator\Validators;

class ArrayValidator
{
    protected bool $required = false;
    protected mixed $shape = [];

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
        return is_array($arr);
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
}

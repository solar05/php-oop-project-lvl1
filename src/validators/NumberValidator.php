<?php

namespace Validator\Validators;

class NumberValidator
{
    protected int $number = 0;
    protected bool $required = false;
    protected bool $positive = false;
    protected mixed $range = [];

    public function isValid(mixed $number): bool
    {
        $rangeSet = $this->range != [];
        if (!$this->required && $number == null) {
            return true;
        }
        if ($this->required && !is_integer($number)) {
            return false;
        }
        if ($this->positive) {
            return $rangeSet ? ($this->inRange($number) && $number > 0) : $number > 0;
        }
        if ($rangeSet) {
            return $this->inRange($number);
        }
        return true;
    }

    public function required(): NumberValidator
    {
        $this->required = true;
        return $this;
    }

    public function range(int $min, int $max): NumberValidator
    {
        $this->range = ['min' => $min, 'max' => $max];
        return $this;
    }

    public function positive(): NumberValidator
    {
        $this->positive = true;
        return $this;
    }

    private function inRange(int $number): bool
    {
        $min = $this->range['min'];
        $max = $this->range['max'];
        return !($number < $min || $number > $max);
    }
}

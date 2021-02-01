<?php

namespace Hexlet\Validator\Validators\Tests\NumberValidator;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class NumberValidatorTest extends TestCase
{
    public function testBase(): void
    {
        $v = new Validator();
        $schema = $v->number();
        $this->assertTrue($schema->isValid(null));
    }

    public function testRequired(): void
    {
        $v = new Validator();
        $schema = $v->number()->required();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(2));
    }

    public function testPositive(): void
    {
        $v = new Validator();
        $schema = $v->number()->positive();
        $this->assertFalse($schema->isValid(-10));
        $this->assertTrue($schema->isValid(10));
    }

    public function testRange(): void
    {
        $v = new Validator();
        $schema = $v->number()->range(-5, 5);
        $this->assertTrue($schema->isValid(5));
        $this->assertTrue($schema->isValid(-3));
        $this->assertFalse($schema->isValid(10));
        $this->assertFalse($schema->isValid(-10));
    }

    public function testAdvancedValidation(): void
    {
        $v = new Validator();
        $schema = $v->number()->positive()->range(-5, 5);
        $this->assertTrue($schema->isValid(5));
        $this->assertFalse($schema->isValid(-3));
    }

    public function testCustomValidations(): void
    {
        $v = new Validator();
        $fn = fn($value, $min) => $value >= $min;
        $v->addValidator('number', 'min', $fn);
        $schema = $v->number()->test('min', 5);
        $this->assertFalse($schema->isValid(4));
        $this->assertTrue($schema->isValid(6));
    }
}

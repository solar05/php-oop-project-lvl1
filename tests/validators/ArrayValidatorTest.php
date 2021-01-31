<?php

namespace Hexlet\Validator\Tests\NumberValidator;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class ArrayValidatorTest extends TestCase
{
    public function testBase(): void
    {
        $v = new Validator();
        $schema = $v->array();
        $this->assertFalse($schema->isValid(null));
    }

    public function testRequired(): void
    {
        $v = new Validator();
        $schema = $v->array()->required();
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['sometest']));
    }

    public function testShape(): void
    {
        $v = new Validator();
        $schema = $v->array();
        $schema->shape([
            'name' => $v->string()->required(),
            'age' => $v->number()->positive(),
        ]);
        $this->assertTrue($schema->isValid(['name' => 'kolya', 'age' => 100]));
        $this->assertTrue($schema->isValid(['name' => 'maya', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => 'ada', 'age' => -5]));
    }
}

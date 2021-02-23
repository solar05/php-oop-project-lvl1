<?php

namespace Hexlet\Validator\Validators\Tests\NumberValidator;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class ArrayValidatorTest extends TestCase
{
    public function testBase(): void
    {
        $v = new Validator();
        $schema = $v->array();
        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid([]));
    }

    public function testRequired(): void
    {
        $v = new Validator();
        $schema = $v->array()->required();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['sometest']));
    }

    public function testSizeof(): void
    {
        $v = new Validator();
        $schema = $v->array();
        $schema->sizeof(2);
        $this->assertFalse($schema->isValid(['hexlet']));
        $this->assertFalse($schema->isValid(['he']));
        $this->assertFalse($schema->isValid([]));
        $this->assertTrue($schema->isValid(['hexlet', 'sometext']));
        $this->assertFalse($schema->isValid(['test' => 'sometext']));
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
        //$this->assertTrue($schema->isValid(['name' => 'maya', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => 'ada', 'age' => -5]));
    }
}

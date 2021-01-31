<?php

namespace Validator\Tests\NumberValidator;

use PHPUnit\Framework\TestCase;
use Validator\Validator;

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
}

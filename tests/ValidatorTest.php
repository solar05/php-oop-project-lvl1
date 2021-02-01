<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class ValidatorTest extends TestCase
{
    public function testMain(): void
    {
        $v = new Validator();
        $schema = $v->number();
        $this->assertTrue($schema->isValid(null));
    }

    public function testStringValidator(): void
    {
        $v = new Validator();
        $schema = $v->string();
        $this->assertTrue($schema->isValid(''));
        $schema->required();
        $this->assertTrue($schema->isValid('what does the fox say'));
        $this->assertTrue($schema->isValid('hexlet'));
        $this->assertFalse($schema->isValid(null));
        $this->assertFalse($schema->isValid(''));
        $this->assertTrue($schema->contains('what')->isValid('what does the fox say'));
        $this->assertFalse($schema->contains('whatthe')->isValid('what does the fox say'));
    }

    public function testArrayValidator(): void
    {
        $v = new Validator();
        $schema = $v->array();
        $this->assertTrue($schema->isValid(null));
        $schema = $schema->required();
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['hexlet']));
        $schema->sizeof(3);
        $this->assertTrue($schema->isValid(['hexlet']));
        $this->assertFalse($schema->isValid(['he']));
        $this->assertFalse($schema->isValid([]));
        $this->assertTrue($schema->isValid(['hexlet', 'sometext']));
        $this->assertFalse($schema->isValid(['hexlet', 'so']));
    }
}

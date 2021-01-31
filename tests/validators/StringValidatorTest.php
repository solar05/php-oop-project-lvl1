<?php

namespace Validator\Tests\StringValidator;

use PHPUnit\Framework\TestCase;
use Validator\Validator;

class StringValidatorTest extends TestCase
{
    public function testBase(): void
    {
        $v = new Validator();
        $schema = $v->string();
        $this->assertTrue($schema->isValid(''));
    }

    public function testRequired(): void
    {
        $v = new Validator();
        $schema = $v->string()->required();
        $this->assertFalse($schema->isValid(''));
    }

    public function testIsValid(): void
    {
        $v = new Validator();
        $schema = $v->string();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid('what does the fox say'));
        $this->assertFalse($schema->isValid(['some word']));
    }

    public function testMinLength(): void
    {
        $v = new Validator();
        $schema = $v->string()->minLength(5);
        $this->assertTrue($schema->isValid('what does the fox say'));
        $this->assertTrue($schema->isValid('tests'));
        $this->assertFalse($schema->isValid('test'));
        $this->assertFalse($schema->isValid(''));
    }

    public function testContains(): void
    {
        $v = new Validator();
        $schema = $v->string();
        $this->assertTrue($schema->contains('what')->isValid('what does the fox say'));
        $this->assertFalse($schema->contains('whatthe')->isValid('what does the fox say'));
    }
}

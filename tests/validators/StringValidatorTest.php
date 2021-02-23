<?php

namespace Hexlet\Validator\Validators\Tests\StringValidator;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

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
        $this->assertTrue($schema->isValid('kolya'));
    }

    public function testIsValid(): void
    {
        $v = new Validator();
        $schema = $v->string();
        $this->assertTrue($schema->isValid(null));
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

    public function testCustomValidations(): void
    {
        $v = new Validator();
        $fn = fn($value, $start) => str_starts_with($value, $start);
        $v->addValidator('string', 'startWith', $fn);
        $schema = $v->string()->test('startWith', 'H');
        $this->assertFalse($schema->isValid('exlet'));
        $this->assertTrue($schema->isValid('Hexlet'));
    }
}

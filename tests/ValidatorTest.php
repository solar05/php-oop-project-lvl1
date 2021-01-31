<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;
use Hexlet\Validator\Validators\StringValidator;

class ValidatorTest extends TestCase
{
    public function testMain(): void
    {
        $v = new Validator();
        $schema = $v->number();
        $this->assertTrue($schema->isValid(null));
    }
}

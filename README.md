### Hexlet tests and linter status:
[![Actions Status](https://github.com/solar05/php-oop-project-lvl1/workflows/hexlet-check/badge.svg)](https://github.com/solar05/php-oop-project-lvl1/actions)

## Description;
PHP library for validation.

## Usage example:
```PHP
<?php
use Hexlet\Validator\Validator;

$v = new \Hexlet\Validator\Validator();

// strings
$schema = $v->required()->string();

$schema->isValid('what does the fox say'); // true
$schema->isValid(''); // false

// numbers
$schema = $v->required()->number()->positive();

$schema->isValid(-10); // false
$schema->isValid(10); // true

// array with checking support
$schema = $v->array()->sizeof(2)->shape([
    'name' => $v->string()->required(),
    'age' => $v->number()->positive(),
]);

$schema->isValid(['name' => 'kolya', 'age' => 100]); // true
$schema->isValid(['name' => '', 'age' => null]); // false

// New validator adding
$fn = fn($value, $start) => str_starts_with($value, $start);
$v->addValidator('string', 'startWith', $fn);

$schema = $v->string()->test('startWith', 'H');

$schema->isValid('exlet'); // false
$schema->isValid('Hexlet'); // true
```

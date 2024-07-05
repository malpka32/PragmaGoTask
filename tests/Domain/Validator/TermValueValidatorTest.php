<?php

namespace Domain\Validator;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Domain\Validator\TermValueValidator;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidTermValueException;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;

class TermValueValidatorTest extends TestCase
{
    private TermValueValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new TermValueValidator();
    }

    public function testValidateValue12(): void
    {
        $this->validator->validate(12);
        $this->assertTrue(true);
    }

    public function testValidateValue24(): void
    {
        $this->validator->validate(24);
        $this->assertTrue(true);
    }

    public function testValidateInvalidValue(): void
    {
        $this->expectException(InvalidTermValueException::class);
        $this->validator->validate(15);
    }

    public function testValidateInvalidValueType(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->validator->validate(123.123);
    }
}

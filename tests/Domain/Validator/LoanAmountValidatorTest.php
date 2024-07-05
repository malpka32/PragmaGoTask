<?php

namespace Domain\Validator;

use PragmaGoTech\Interview\Domain\Validator\LoanAmountValidator;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidLoanAmountException;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;

class LoanAmountValidatorTest extends TestCase
{
    private LoanAmountValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new LoanAmountValidator();
    }

    public function testValidateThrowsInvalidValueTypeException(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->validator->validate("5000");
    }

    public function testValidateThrowsInvalidLoanAmountExceptionForLowValue(): void
    {
        $this->expectException(InvalidLoanAmountException::class);
        $this->validator->validate(999.99);
    }

    public function testValidateThrowsInvalidLoanAmountExceptionForHighValue(): void
    {
        $this->expectException(InvalidLoanAmountException::class);
        $this->validator->validate(20000.01);
    }

    public function testValidateDoesNotThrowExceptionForHighValue(): void
    {
        $this->validator->validate(19999.99);
        $this->assertTrue(true);
    }

    public function testValidateDoesNotThrowExceptionForLowValue(): void
    {
        $this->validator->validate(1000.01);
        $this->assertTrue(true);
    }
}

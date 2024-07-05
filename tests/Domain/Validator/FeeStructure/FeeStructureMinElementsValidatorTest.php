<?php

namespace Domain\Validator\FeeStructure;

use PragmaGoTech\Interview\Domain\Validator\FeeStructure\FeeStructureMinElementsValidator;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidFeeStructureMinElementsException;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureProviderInterface;

class FeeStructureMinElementsValidatorTest extends TestCase
{
    private FeeStructureMinElementsValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new FeeStructureMinElementsValidator();
    }

    public function testValidateThrowsInvalidValueTypeException(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->validator->validate("5");
    }

    public function testValidateThrowsInvalidMinElementsExceptionForNonElements(): void
    {
        $this->expectException(InvalidFeeStructureMinElementsException::class);
        $mock = $this->createMock(FeeStructureProviderInterface::class);
        $mock->method('getFeeStructureForMonths')
            ->withAnyParameters()
            ->willReturn([]);
        $this->validator->validate($mock);
    }

    public function testValidate(): void
    {
        $mock = $this->createMock(FeeStructureProviderInterface::class);
        $mock->method('getFeeStructureForMonths')
            ->withAnyParameters()
            ->willReturn(['', '']);
        $this->validator->validate($mock);
        $this->assertTrue(true);
    }
}

<?php

namespace Domain\Validator\FeeStructure;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Domain\Validator\FeeStructure\FeeStructureRequiredBoundValidator;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidFeeStructureRequiredBoundException;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureProviderInterface;

class FeeStructureRequiredBoundValidatorTest extends TestCase
{
    private FeeStructureRequiredBoundValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new FeeStructureRequiredBoundValidator();
    }

    public function testValidateThrowsInvalidValueTypeException(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->validator->validate("5");
    }

    public function testValidateThrowsInvalidMinElementsExceptionForNonElements(): void
    {
        $this->expectException(InvalidFeeStructureRequiredBoundException::class);
        $mock = $this->createMock(FeeStructureProviderInterface::class);
        $mock->method('getFeeStructureForMonths')
            ->withAnyParameters()
            ->willReturn([
                '1000.1' => 50,
                20000 => 500
            ]);
        $this->validator->validate($mock);
    }

    public function testValidate(): void
    {
        $mock = $this->createMock(FeeStructureProviderInterface::class);
        $mock->method('getFeeStructureForMonths')
            ->withAnyParameters()
            ->willReturn([
                20000 => 100,
                1000 => 10
            ]);
        $this->validator->validate($mock);
        $this->assertTrue(true);
    }
}

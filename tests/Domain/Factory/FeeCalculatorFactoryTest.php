<?php

namespace Domain\Factory;

use PragmaGoTech\Interview\Domain\Factory\FeeCalculatorFactory;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Domain\Service\FeeCalculator;

class FeeCalculatorFactoryTest extends TestCase
{
    public function testCreateReturnsFeeCalculatorInstance(): void
    {
        // Act
        $feeCalculator = FeeCalculatorFactory::create();

        // Assert
        $this->assertInstanceOf(FeeCalculator::class, $feeCalculator);
    }
}

<?php

namespace PragmaGoTech\Interview\Domain\Validator\FeeStructure;

use PragmaGoTech\Interview\Domain\Validator\ValidatorInterface;
use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidFeeStructureMinElementsException;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureProviderInterface;

class FeeStructureMinElementsValidator implements ValidatorInterface
{
    private const int MIN_ELEMENTS = 2;

    public function validate(mixed $value): void
    {
        if (!$value instanceof FeeStructureProviderInterface) {
            throw new InvalidValueTypeException();
        }

        foreach(TermMonthDictionary::cases() as $case) {
            if (count($value->getFeeStructureForMonths($case)) < self::MIN_ELEMENTS) {
                throw new InvalidFeeStructureMinElementsException();
            }
        }
    }
}

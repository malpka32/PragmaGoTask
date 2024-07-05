<?php

namespace PragmaGoTech\Interview\Domain\Validator\FeeStructure;

use PragmaGoTech\Interview\Domain\Validator\ValidatorInterface;
use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidFeeStructureRequiredBoundException;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureProviderInterface;

class FeeStructureRequiredBoundValidator implements ValidatorInterface
{
    private const float MIN_BOUND = 1000;
    private const float MAX_BOUND = 20000;

    public function validate(mixed $value): void
    {
        if (!$value instanceof FeeStructureProviderInterface) {
            throw new InvalidValueTypeException();
        }

        foreach(TermMonthDictionary::cases() as $case) {
            $keys = array_keys($value->getFeeStructureForMonths($case));
            if (array_search(self::MIN_BOUND, $keys) === false
                || array_search(self::MAX_BOUND, $keys) === false
            ) {
                throw new InvalidFeeStructureRequiredBoundException();
            }
        }
    }
}

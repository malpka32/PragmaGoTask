<?php

namespace PragmaGoTech\Interview\Domain\Validator;

use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidTermValueException;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;

class TermValueValidator implements ValidatorInterface
{
    /**
     * @throws InvalidTermValueException
     * @throws InvalidValueTypeException
     */
    public function validate(mixed $value): void
    {
        if(!is_int($value) && !is_string($value)) {
            throw new InvalidValueTypeException();
        }

        if (!TermMonthDictionary::tryFrom($value)) {
            throw new InvalidTermValueException();
        }
    }
}

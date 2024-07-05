<?php

namespace PragmaGoTech\Interview\Domain\Validator;

use PragmaGoTech\Interview\Infrastructure\Exception\InvalidLoanAmountException;
use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;

class LoanAmountValidator implements ValidatorInterface
{
    private const int MIN_AMOUNT = 1000;
    private const int MAX_AMOUNT = 20000;

    /**
     * @throws InvalidLoanAmountException
     * @throws InvalidValueTypeException
     */
    public function validate(mixed $value): void
    {
        if (!is_float($value)) {
            throw new InvalidValueTypeException();
        }

        if ($value < self::MIN_AMOUNT || $value > self::MAX_AMOUNT) {
            throw new InvalidLoanAmountException();
        }
    }
}

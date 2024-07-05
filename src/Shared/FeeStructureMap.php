<?php

namespace PragmaGoTech\Interview\Shared;

use PragmaGoTech\Interview\Infrastructure\Exception\InvalidValueTypeException;
use PragmaGoTech\Interview\Shared\Collection\FeeForLoanCollection;

class FeeStructureMap implements FeeStructureMapInterface
{
    /**
     * @param array<int|string, int> $feeForLoan
     * @return FeeForLoanCollection
     * @throws InvalidValueTypeException
     */
    public function map(mixed $feeForLoan): FeeForLoanCollection
    {
        if (!is_array($feeForLoan)) {
            throw new InvalidValueTypeException();
        }
        $feeForLoanCollection = new FeeForLoanCollection();
        foreach ($feeForLoan as $loanAmount => $feeAmount) {
            $feeForLoanCollection->add(
                new FeeForLoan(
                    new Loan((float) $loanAmount),
                    new Fee($feeAmount)
                )
            );
        }
        return $feeForLoanCollection;
    }
}
<?php

namespace PragmaGoTech\Interview\Domain\Strategy\Fee;

use PragmaGoTech\Interview\Shared\Collection\FeeForLoanCollection;
use PragmaGoTech\Interview\Shared\Collection\FeeLinearInterpolationBoundCollection;
use PragmaGoTech\Interview\Shared\Fee;
use PragmaGoTech\Interview\Shared\Loan;

class FeeLinearInterpolationStrategy implements FeeCalculationStrategyInterface {

    private function calculateInterpolationRatio(
        Loan $loan,
        FeeLinearInterpolationBoundCollection $boundCollection
    ): float
    {
        $lowerLoan = $boundCollection->getLow()->getLoan()->getAmount();
        $upperLoan = $boundCollection->getHigh()->getLoan()->getAmount();

        return ($loan->getAmount() - $lowerLoan) / ($upperLoan - $lowerLoan);
    }

    private function interpolate(Loan $amount, FeeLinearInterpolationBoundCollection $boundCollection): Fee
    {
        if ($boundCollection->isSameBoundOrFee()) {
            return $boundCollection->getLow()->getFee();
        }
        $lowerBound = $boundCollection->getLow();
        $upperBound = $boundCollection->getHigh();
        $lowerFee = $lowerBound->getFee()->getAmount();
        $upperFee = $upperBound->getFee()->getAmount();
        $ratio = $this->calculateInterpolationRatio($amount, $boundCollection);

        $result = $lowerFee + ($ratio * ($upperFee - $lowerFee));

        return new Fee($result);
    }

    public function calculateFee(Loan $loan, FeeForLoanCollection $feeStructure): Fee
    {
        $bound = $feeStructure->findBoundsForLoanAmount($loan);

        return $this->interpolate($loan, $bound);
    }
}
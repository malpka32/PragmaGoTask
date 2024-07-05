<?php

namespace PragmaGoTech\Interview\Shared\Collection;

use PragmaGoTech\Interview\Shared\FeeForLoan;
use PragmaGoTech\Interview\Shared\Loan;

class FeeLinearInterpolationBoundCollection extends FeeForLoanCollection implements CollectionInterface
{
    public function getLow(): FeeForLoan
    {
        $this->sortForLinearInterpolate();

        return $this->first();
    }

    public function getHigh(): FeeForLoan
    {
        $this->sortForLinearInterpolate();

        return $this->last();
    }

    public function isSameBoundOrFee(): bool
    {
        $low = $this->getLow();
        $high = $this->getHigh();
        return $low->getLoan()->getAmount() === $high->getLoan()->getAmount()
            || $low->getFee()->getAmount() === $high->getFee()->getAmount();
    }
}
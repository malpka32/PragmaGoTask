<?php

namespace PragmaGoTech\Interview\Shared;

readonly class Loan
{
    private Money $loan;

    public function __construct(float $loan)
    {
        $this->loan = new Money($loan);
    }

    public function getAmount(): float
    {
        return $this->loan->getAmount();
    }
}
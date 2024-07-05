<?php

namespace PragmaGoTech\Interview\Shared;

use PragmaGoTech\Interview\Shared\Collection\CollectionItemInterface;

readonly class FeeForLoan implements CollectionItemInterface
{
    public function __construct(
        private Loan $loan,
        private Fee $fee,
    ){}

    public function getLoan(): Loan {
        return $this->loan;
    }

    public function getFee(): Fee {
        return $this->fee;
    }
}
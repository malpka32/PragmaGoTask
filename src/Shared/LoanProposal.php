<?php

namespace PragmaGoTech\Interview\Shared;

readonly class LoanProposal
{
    public function __construct(
        private Term $term,
        private Loan $loan
    ) {}

    public function getTerm(): Term
    {
        return $this->term;
    }

    public function getLoan(): Loan
    {
        return $this->loan;
    }
}

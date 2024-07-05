<?php

namespace PragmaGoTech\Interview\Domain\Factory;

use PragmaGoTech\Interview\Domain\Validator\LoanAmountValidator;
use PragmaGoTech\Interview\Domain\Validator\ValidatorChain;
use PragmaGoTech\Interview\Shared\Loan;
use PragmaGoTech\Interview\Shared\LoanProposal;

class LoanProposalFactory
{
    public static function create(int $term, float $amount): LoanProposal
    {
        $validatorChain = new ValidatorChain();
        $validatorChain
            ->addValidator(new LoanAmountValidator());
        $validatorChain->validate($amount);

        return new LoanProposal(
            TermFactory::create($term),
            new Loan($amount)
        );
    }
}

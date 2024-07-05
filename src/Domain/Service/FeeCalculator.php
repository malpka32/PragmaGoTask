<?php

namespace PragmaGoTech\Interview\Domain\Service;

use PragmaGoTech\Interview\Domain\Strategy\Fee\FeeCalculationStrategyInterface;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureRepositoryInterface;
use PragmaGoTech\Interview\Shared\Fee;
use PragmaGoTech\Interview\Shared\LoanProposal;

readonly class FeeCalculator
{
    public function __construct(
        private FeeStructureRepositoryInterface $feeStructureRepository,
        private FeeCalculationStrategyInterface $strategy
    ) {}

    public function calculate(LoanProposal $loanProposal): Fee
    {
        $amount = $loanProposal->getLoan();
        $term = $loanProposal->getTerm();

        $feeStructure = $this->feeStructureRepository->getFeeStructureForTerm($term);
        return $this->strategy->calculateFee($amount, $feeStructure);
    }
}

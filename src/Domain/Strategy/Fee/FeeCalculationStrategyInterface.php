<?php

namespace PragmaGoTech\Interview\Domain\Strategy\Fee;
use PragmaGoTech\Interview\Shared\Collection\FeeForLoanCollection;
use PragmaGoTech\Interview\Shared\Fee;
use PragmaGoTech\Interview\Shared\Loan;

interface FeeCalculationStrategyInterface {
    public function calculateFee(Loan $loan, FeeForLoanCollection $feeStructure): Fee;
}
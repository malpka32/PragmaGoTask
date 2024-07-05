<?php

namespace PragmaGoTech\Interview\Infrastructure\Repository\Interface;

use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;
use PragmaGoTech\Interview\Shared\Collection\FeeForLoanCollection;

interface FeeStructureProviderInterface
{
    /**
     * @param TermMonthDictionary $termDictionary
     * @return array<int|string, int>
     */
    public function getFeeStructureForMonths(TermMonthDictionary $termDictionary): array;

    public function getFeeForLoan(TermMonthDictionary $termMonthDictionary): FeeForLoanCollection;
}

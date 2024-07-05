<?php

namespace PragmaGoTech\Interview\Infrastructure\Repository\Interface;

use PragmaGoTech\Interview\Shared\Collection\FeeForLoanCollection;
use PragmaGoTech\Interview\Shared\Term;

interface FeeStructureRepositoryInterface
{
    public function getFeeStructureForTerm(Term $term): FeeForLoanCollection;
}

<?php

namespace PragmaGoTech\Interview\Shared;

use PragmaGoTech\Interview\Shared\Collection\FeeForLoanCollection;

interface FeeStructureMapInterface
{
    public function map(mixed $feeForLoan): FeeForLoanCollection;
}
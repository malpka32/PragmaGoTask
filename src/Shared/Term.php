<?php

namespace PragmaGoTech\Interview\Shared;

use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;

readonly class Term
{
    public function __construct(
        private TermMonthDictionary $months
    ) {}

    public function getMonths(): int
    {
        return $this->months->value;
    }
}

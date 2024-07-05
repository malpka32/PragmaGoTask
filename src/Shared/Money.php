<?php

namespace PragmaGoTech\Interview\Shared;

readonly class Money
{
    public function __construct(
        private float $amount
    ) {}

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function roundUpToNearestFive(): Money
    {
        return new Money(ceil($this->amount / 5) * 5);
    }
}

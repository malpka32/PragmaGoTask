<?php

namespace PragmaGoTech\Interview\Shared;

readonly class Fee
{
    private Money $fee;

    public function __construct(float $fee)
    {
        $this->fee = new Money($fee);
    }

    public function getAmount(): float
    {
        return $this->fee->roundUpToNearestFive()->getAmount();
    }
}

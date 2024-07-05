<?php

namespace PragmaGoTech\Interview\Infrastructure\Repository;

use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureProviderInterface;
use PragmaGoTech\Interview\Shared\Collection\FeeForLoanCollection;
use PragmaGoTech\Interview\Shared\FeeStructureMapInterface;

class FeeStructureProvider implements FeeStructureProviderInterface {

    private const array FEE_STRUCTURE_12 = [
        1000 => 50,
        '2000.20' => 90,
        3000 => 90,
        4000 => 115,
        5000 => 100,
        6000 => 120,
        7000 => 140,
        8000 => 160,
        9000 => 180,
        10000 => 200,
        11000 => 220,
        12000 => 240,
        13000 => 260,
        14000 => 280,
        15000 => 300,
        16000 => 320,
        17000 => 340,
        18000 => 360,
        19000 => 380,
        20000 => 400
    ];

    private const array FEE_STRUCTURE_24 = [
        1000 => 70,
        2000 => 100,
        3000 => 120,
        4000 => 160,
        5000 => 200,
        6000 => 240,
        7000 => 280,
        8000 => 320,
        9000 => 360,
        10000 => 400,
        11000 => 440,
        12000 => 480,
        13000 => 520,
        14000 => 560,
        15000 => 600,
        16000 => 640,
        17000 => 680,
        18000 => 720,
        19000 => 760,
        20000 => 800,
    ];

    public function __construct(
        private readonly FeeStructureMapInterface $feeStructureMap
    ){}

    /**
     * @param TermMonthDictionary $termDictionary
     * @return array<int|string, int>
     */
    public function getFeeStructureForMonths(TermMonthDictionary $termDictionary): array
    {
        return match ($termDictionary) {
            TermMonthDictionary::MONTHS_12 => self::FEE_STRUCTURE_12,
            TermMonthDictionary::MONTHS_24 => self::FEE_STRUCTURE_24,
        };
    }

    public function getFeeForLoan(TermMonthDictionary $termMonthDictionary): FeeForLoanCollection
    {
        return $this->feeStructureMap->map(
            $this->getFeeStructureForMonths($termMonthDictionary)
        );
    }
}
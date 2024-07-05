<?php

namespace PragmaGoTech\Interview\Infrastructure\Repository;

use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureProviderInterface;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureRepositoryInterface;
use PragmaGoTech\Interview\Shared\Collection\FeeForLoanCollection;
use PragmaGoTech\Interview\Shared\Term;

class FeeStructureRepository implements FeeStructureRepositoryInterface
{
    /**
     * @var array <int, FeeForLoanCollection>
     */
    private array $feeStructures;

    public function __construct(
        readonly FeeStructureProviderInterface $feeStructureProvider
    ) {
        $this->feeStructures = [];
        $this->setFeeStructures();
    }

    private function setFeeStructures(): void
    {
        foreach (TermMonthDictionary::cases() as $case) {
            $this->feeStructures[$case->value] = $this->feeStructureProvider->getFeeForLoan($case);
        }
    }

    public function getFeeStructureForTerm(Term $term): FeeForLoanCollection
    {
        $termMonthDirectory = TermMonthDictionary::from($term->getMonths());
        return $this->feeStructures[$termMonthDirectory->value];
    }
}

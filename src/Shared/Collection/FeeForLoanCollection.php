<?php

namespace PragmaGoTech\Interview\Shared\Collection;

use PragmaGoTech\Interview\Shared\FeeForLoan;
use PragmaGoTech\Interview\Shared\Loan;

class FeeForLoanCollection extends Collection implements CollectionInterface
{
    /**
     * @param FeeForLoan[] $items
     */
    public function __construct(array $items = [])
    {
        parent::__construct();
        $this->setItems($items);
    }

    /**
     * @param FeeForLoan[] $items
     */
    protected function setItems(array $items = []): void
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function add(mixed $item): CollectionInterface
    {
        if(!$item instanceof FeeForLoan) {
            throw new \InvalidArgumentException("Item must be instance of FeeForLoan");
        }
        return parent::add($item);
    }

    public function sortForLinearInterpolate(): self
    {
        usort($this->items, function (FeeForLoan $a, FeeForLoan $b) {
            return $a->getLoan()->getAmount() <=> $b->getLoan()->getAmount();
        });

        return $this;
    }

    public function findBoundsForLoanAmount(Loan $loan): FeeLinearInterpolationBoundCollection
    {
        $this->sortForLinearInterpolate();
        $lowerBound = $this->first();
        $upperBound = $this->last();
        foreach ($this->items as $item) {
            if($item->getLoan()->getAmount() <= $loan->getAmount()) {
                $lowerBound = $item;
            }
            if($item->getLoan()->getAmount() >= $loan->getAmount()) {
                $upperBound = $item;
                break;
            }
        }
        return new FeeLinearInterpolationBoundCollection([
            $lowerBound,
            $upperBound,
        ]);
    }
}
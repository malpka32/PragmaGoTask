<?php

namespace PragmaGoTech\Interview\Domain\Factory;

use PragmaGoTech\Interview\Domain\Validator\TermValueValidator;
use PragmaGoTech\Interview\Domain\Validator\ValidatorChain;
use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;
use PragmaGoTech\Interview\Shared\Term;

class TermFactory
{
    public static function create(int $term): Term
    {
        $validatorChain = new ValidatorChain();
        $validatorChain
            ->addValidator(new TermValueValidator());
        $validatorChain->validate($term);

        return new Term(TermMonthDictionary::from($term));
    }
}

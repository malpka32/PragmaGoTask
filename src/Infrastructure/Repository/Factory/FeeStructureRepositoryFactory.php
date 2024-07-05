<?php

namespace PragmaGoTech\Interview\Infrastructure\Repository\Factory;

use PragmaGoTech\Interview\Domain\Validator\ValidatorChain;
use PragmaGoTech\Interview\Infrastructure\Repository\FeeStructureRepository;
use PragmaGoTech\Interview\Infrastructure\Repository\Interface\FeeStructureProviderInterface;

readonly class FeeStructureRepositoryFactory
{
    public function __construct(
        private ValidatorChain $validatorChain
    ) {}

    public function create(FeeStructureProviderInterface $feeStructureProvider): FeeStructureRepository
    {
        $this->validatorChain->validate($feeStructureProvider);

        return new FeeStructureRepository($feeStructureProvider);
    }
}

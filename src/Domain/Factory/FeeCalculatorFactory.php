<?php

namespace PragmaGoTech\Interview\Domain\Factory;

use PragmaGoTech\Interview\Domain\Service\FeeCalculator;
use PragmaGoTech\Interview\Domain\Strategy\Fee\FeeLinearInterpolationStrategy;
use PragmaGoTech\Interview\Domain\Validator\FeeStructure\FeeStructureMinElementsValidator;
use PragmaGoTech\Interview\Domain\Validator\FeeStructure\FeeStructureRequiredBoundValidator;
use PragmaGoTech\Interview\Domain\Validator\ValidatorChain;
use PragmaGoTech\Interview\Infrastructure\Repository\Factory\FeeStructureRepositoryFactory;
use PragmaGoTech\Interview\Infrastructure\Repository\FeeStructureProvider;
use PragmaGoTech\Interview\Shared\FeeStructureMap;

class FeeCalculatorFactory
{
    public static function create(): FeeCalculator
    {
        $repositoryValidatorChain = new ValidatorChain();
        $repositoryValidatorChain
            ->addValidator(new FeeStructureMinElementsValidator())
            ->addValidator(new FeeStructureRequiredBoundValidator());

        $feeStructureRepositoryFactory = new FeeStructureRepositoryFactory($repositoryValidatorChain);
        $feeStructureRepository = $feeStructureRepositoryFactory->create(
            new FeeStructureProvider(new FeeStructureMap())
        );

        return new FeeCalculator($feeStructureRepository, new FeeLinearInterpolationStrategy());
    }
}

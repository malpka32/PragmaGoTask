<?php

namespace PragmaGoTech\Interview\Application;

require 'vendor/autoload.php';

use PragmaGoTech\Interview\Domain\Factory\FeeCalculatorFactory;
use PragmaGoTech\Interview\Domain\Factory\LoanProposalFactory;

$calculator = FeeCalculatorFactory::create();

$fee = $calculator->calculate(
    LoanProposalFactory::create(24, 2750)
);

echo 'For loan 2750 and term 24 month - Fee will be: ' . $fee->getAmount();
echo "\r\n";
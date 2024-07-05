<?php

namespace PragmaGoTech\Interview\Infrastructure\Exception;

use Exception;

class InvalidLoanAmountException extends Exception
{
    public function __construct(
        string $message = "Invalid loan amount.",
        int $code = 13,
        Exception $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
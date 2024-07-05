<?php

namespace PragmaGoTech\Interview\Infrastructure\Exception;

use Exception;

class InvalidFeeStructureRequiredBoundException extends Exception
{
    public function __construct(
        string $message = "Invalid fee structure required bound.",
        int $code = 12,
        Exception $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
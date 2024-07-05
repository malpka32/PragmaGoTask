<?php

namespace PragmaGoTech\Interview\Infrastructure\Exception;

use Exception;

class InvalidFeeStructureMinElementsException extends Exception
{
    public function __construct(
        string $message = "Invalid fee structure elements.",
        int $code = 11,
        Exception $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
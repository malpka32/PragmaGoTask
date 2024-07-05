<?php

namespace PragmaGoTech\Interview\Infrastructure\Exception;

use Exception;

class InvalidTermValueException extends Exception
{
    public function __construct(
        string $message = "Invalid term value.",
        int $code = 14,
        Exception $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
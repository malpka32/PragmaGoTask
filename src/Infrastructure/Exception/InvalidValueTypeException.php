<?php

namespace PragmaGoTech\Interview\Infrastructure\Exception;

use Exception;

class InvalidValueTypeException extends Exception
{
    public function __construct(
        string $message = "Invalid value type.",
        int $code = 15,
        Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
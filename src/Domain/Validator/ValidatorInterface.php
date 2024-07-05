<?php

namespace PragmaGoTech\Interview\Domain\Validator;

interface ValidatorInterface
{
    public function validate(mixed $value): void;
}

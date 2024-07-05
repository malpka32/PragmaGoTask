<?php

namespace PragmaGoTech\Interview\Domain\Validator;

class ValidatorChain
{
    /**
     * @var ValidatorInterface[]
     */
    private array $validators = [];

    public function addValidator(ValidatorInterface $validator): self
    {
        $this->validators[] = $validator;
        return $this;
    }

    public function validate(mixed $value): void
    {
        foreach ($this->validators as $validator) {
            $validator->validate($value);
        }
    }
}

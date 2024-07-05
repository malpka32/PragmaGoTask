<?php

namespace PragmaGoTech\Interview\Shared\Collection;

interface CollectionInterface
{
    public function add(mixed $item): CollectionInterface;

    public function get(int $index): mixed;
}
<?php

namespace PragmaGoTech\Interview\Shared\Collection;

class Collection implements CollectionInterface
{
    public function __construct(
        protected array $items = []
    ){}

    public function add(mixed $item): CollectionInterface
    {
        $this->items[] = $item;

        return $this;
    }

    public function get(int $index): CollectionItemInterface
    {
        return $this->items[$index];
    }

    public function first(): CollectionItemInterface
    {
        return reset($this->items);
    }

    public function last(): CollectionItemInterface
    {
        return end($this->items);
    }
}
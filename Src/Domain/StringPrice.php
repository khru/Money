<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

class StringPrice implements PriceAble
{
    private $price;

    private function __construct(string $price)
    {
        $this->setPrice($price);
    }

    private function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function __toString(): string
    {
        return $this->price;
    }
}

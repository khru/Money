<?php

namespace WeDev\Price\Domain;

use WeDev\Price\PriceAble;

class NumericPrice implements PriceAble
{
    private $integer;
    private $decimal;

    private function __construct(int $integer, int $decimal)
    {
        $this->integer = $integer;
        $this->decimal = $decimal;
    }

    public function getFloatingPrice(): float
    {
        return (float) ($this->integer . '.' . $this->decimal);
    }

    public function __toString()
    {
        return (string) $this->integer . '.' . $this->decimal;
    }

    public static function createPrice(int $integer, int $decimal): self
    {
        return new static($integer, $decimal);
    }

}

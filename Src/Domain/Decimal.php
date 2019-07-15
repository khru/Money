<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

class Decimal implements NumericPartInterface, DecimalPartInterface
{
    private $decimal;

    private function __construct(int $decimal)
    {
        $this->decimal = $decimal;
    }

    public function __toString(): string
    {
        return (string) $this->decimal;
    }

    public function getDecimals(): int
    {
        return $this->decimal;
    }

    public function equals(DecimalPartInterface $numericPart): bool
    {
        return $this->getDecimals() === $numericPart->getDecimals();
    }

    public function __invoke(): int
    {
        return $this->getDecimals();
    }
}

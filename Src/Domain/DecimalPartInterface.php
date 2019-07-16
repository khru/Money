<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

interface DecimalPartInterface
{
    public function getDecimals(): string;

    public function equals(DecimalPartInterface $decimalPart): bool;
}
